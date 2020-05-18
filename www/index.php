<?php
$vdir = getenv('COMPOSER_VENDOR_DIR');
define('APP_ROOT', dirname(__FILE__) . '/../');
define('APP_SRC', dirname(__FILE__) . '/../src');
define('APP_CACHE', dirname(__FILE__) . '/../cache');
define('APP_LOG', dirname(__FILE__) . '/../log');
if ($vdir == '') {
    define('APP_MOD', dirname(__FILE__) . '/../vendor/');
} else {
    define('APP_MOD', rtrim($vdir) . '/');
}
define('APP_NAME', 'FREEASSO');
define('API_SCHEMES', 'https');
define('API_HOST', 'freeasso.fr');

$startTs = microtime(true);

/**
 * Boot
 */
require_once APP_SRC . '/bootstrap.php';
/**
 * Recherche du fichier de configuration associée au serveur (virtualHost)
 */
$server = 'freeasso-dev';
if (isset($_SERVER['SERVER_NAME'])) {
    $server = $_SERVER['SERVER_NAME'];
}

/**
 * Fichier de configuration
 */
if (is_file(APP_ROOT . '/config/' . strtolower($server) . '.ini.php')) {
    require_once APP_ROOT . '/config/' . strtolower($server) . '.ini.php';
} else {
    $server = gethostname();
    if (is_file(APP_ROOT . '/config/' . strtolower($server) . '.ini.php')) {
        require_once APP_ROOT . '/config/' . strtolower($server) . '.ini.php';
    } else {
        require_once APP_ROOT . '/config/ini.php';
    }
}

/**
 * Go
 */
try {
    // Réponse aux "preflights", on sort direct.... c'est à gérer côté serveur web
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('HTTP/1.1 200 OK');
        exit(0);
    }
    // Si pas de "prefligths" : Config
    if (is_file(APP_ROOT . '/config/' . strtolower($server) . '.config.php')) {
        $myConfig = \FreeFW\Application\Config::load(APP_ROOT . '/config/' . strtolower($server) . '.config.php');
    } else {
        $myConfig = \FreeFW\Application\Config::load(APP_ROOT . '/config/config.php');
    }
    // Le logger
    $myLogCfg = $myConfig->get('logger');
    if (is_array($myLogCfg)) {
        if (array_key_exists('file', $myLogCfg)) {
            if (array_key_exists('level', $myLogCfg)) {
                $logFile  = $myLogCfg['file'];
                $myLogger = new \FreeFW\Log\FileLogger($logFile, $myLogCfg['level']);
            } else {
                throw new \InvalidArgumentException('Log level missing !');
            }
        } else {
            throw new \UnexpectedValueException('Log type is unknown !');
        }
    } else {
        $myLogger = new \Psr\Log\NullLogger();
    }
    // Queue
    $myQueue    = false;
    $myQueueCfg = $myConfig->get('queue');
    if (is_array($myQueueCfg)) {
        $myQueue = \PhpAmqpLib\Connection\AMQPStreamConnection::create_connection([
            [
                'host' => $myQueueCfg['host'],
                'port' => $myQueueCfg['port'],
                'user' => $myQueueCfg['user'],
                'password' => $myQueueCfg['paswd']
            ]
        ]);
    }
    // La connexion DB
    $myStgCfg = $myConfig->get('storage');
    if (is_array($myStgCfg)) {
        foreach ($myStgCfg as $key => $stoCfg) {
            $storage = \FreeFW\Storage\StorageFactory::getFactory(
                $stoCfg['dsn'],
                $stoCfg['user'],
                $stoCfg['paswd']
            );
            $storage->setLogger($myLogger);
            \FreeFW\DI\DI::setShared('Storage::' . $key, $storage);
        }
    } else {
        throw new \FreeFW\Core\FreeFWException('No storage configuration found !');
    }
    // Micro application
    $app = \FreeFW\Application\Application::getInstance($myConfig, $myLogger);
    // EventManager
    $myEvents = \FreeFW\Listener\EventManager::getInstance();
    // 404
    $myEvents->bind(\FreeFW\Constants::EVENT_ROUTE_NOT_FOUND, function () use ($app) {
        // @todo
        $app->sendHttpCode(404);
    });
    // Render finished
    $myEvents->bind(\FreeFW\Constants::EVENT_AFTER_RENDER, function () use ($app, $startTs) {
        $endTs = microtime(true);
        $diff  = $endTs - $startTs;
        $app->getLogger()->info('Total execution time : ' . $diff);
    });
    // CRUD for notifications and cache clear
    if ($myQueue) {
        // Were not async and transactions are global and transactions start-end is linear.
        // @TODO : Send updates just on commit... or if not transaction on
        // We can use a static tables of data befofe send... or an app member...
        $myEvents->bind(
            [
                \FreeFW\Constants::EVENT_STORAGE_CREATE,
                \FreeFW\Constants::EVENT_STORAGE_UPDATE,
                \FreeFW\Constants::EVENT_STORAGE_DELETE,
                \FreeFW\Constants::EVENT_STORAGE_BEGIN,
                \FreeFW\Constants::EVENT_STORAGE_COMMIT,
                \FreeFW\Constants::EVENT_STORAGE_ROLLBACK,
            ],
            function ($p_object) use ($app, $myQueue, $myQueueCfg) {
                $app->listen($p_object, $myQueue, $myQueueCfg);
            }
        );
    }
    /**
     * FreeAsso DI
     */
    \FreeFW\DI\DI::registerDI('FreeFW', $myConfig, $myLogger);
    \FreeFW\DI\DI::registerDI('FreeAsso', $myConfig, $myLogger);
    \FreeFW\DI\DI::registerDI('FreeSSO', $myConfig, $myLogger);
    \FreeFW\DI\DI::registerDI('FreePM', $myConfig, $myLogger);
    /**
     * On va chercher les routes des modules, ...
     */
    $freeFWRoutes   = \FreeFW\Http\FreeFW::getRoutes();
    $freeSSORoutes  = \FreeSSO\Http\FreeFW::getRoutes();
    $freeAssoRoutes = \FreeAsso\Http\FreeFW::getRoutes();
    $freePMRoutes   = \FreePM\Http\FreeFW::getRoutes();
    /**
     * GO...
     */
    $app
        ->setEventManager($myEvents)
        ->addRoutes($freeAssoRoutes)
        ->addRoutes($freeSSORoutes)
        ->addRoutes($freeFWRoutes)
        ->addRoutes($freePMRoutes)
    ;
    // GO
    $app->handle();
    // Finish
    if ($myQueue) {
        $myQueue->close();
    }
} catch (\Exception $ex) {
    // @todo
    //var_dump($ex);
}
