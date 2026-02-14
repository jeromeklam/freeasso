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
define('APP_HISTORY', true);
define('APP_SYSTEM', false);

$startTs = microtime(true);

/**
 * Boot
 */
require_once APP_SRC . '/bootstrap.php';
/**
 * Recherche du fichier de configuration associée au serveur (virtualHost)
 */
$server = getenv('SERVER_NAME');
if (!$server) {
    $server = 'docker-dev';
}

/**
 * Fichier de configuration
 */
if (is_file(APP_ROOT . '/config/' . strtolower($server) . '.ini-cli.php')) {
    require_once APP_ROOT . '/config/' . strtolower($server) . '.ini-cli.php';
} else {
    $server = gethostname();
    if (is_file(APP_ROOT . '/config/' . strtolower($server) . '.ini-cli.php')) {
        require_once APP_ROOT . '/config/' . strtolower($server) . '.ini-cli.php';
    } else {
        require_once APP_ROOT . '/config/ini-cli.php';
    }
}

/**
 * Go
 */
try {
    // Si pas de "prefligths" : Config
    if (is_file(APP_ROOT . '/config/' . strtolower($server) . '.config-cli.php')) {
        $myConfig = \FreeFW\Application\Config::load(APP_ROOT . '/config/' . strtolower($server) . '.config-cli.php');
    } else {
        $myConfig = \FreeFW\Application\Config::load(APP_ROOT . '/config/config-cli.php');
    }
    // Le logger
    $myLogCfg = $myConfig->get('logger');
    if (is_array($myLogCfg)) {
        if (array_key_exists('file', $myLogCfg)) {
            if (array_key_exists('level', $myLogCfg)) {
                $logFile  = str_replace('.log', '-tech.log', $myLogCfg['file']);
                $myLogger = new \FreeFW\Log\FileLogger($logFile, $myLogCfg['level'], false);
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
    // EventManager
    $myEvents = \FreeFW\Listener\EventManager::getInstance();
    // La connexion DB
    $myStgCfg = $myConfig->get('storage');
    if (is_array($myStgCfg)) {
        foreach ($myStgCfg as $key => $stoCfg) {
            $storage = \FreeFW\Storage\StorageFactory::getFactory(
                $stoCfg['dsn'],
                $stoCfg['user'],
                $stoCfg['paswd'],
                $myLogger,
                $myEvents,
                $myConfig
            );
            \FreeFW\DI\DI::setShared('Storage::' . $key, $storage);
        }
    } else {
        throw new \FreeFW\Core\FreeFWException('No storage configuration found !');
    }
    // Micro application
    $app = \FreeFW\Application\Console::getInstance($myConfig, $myLogger, $myConfig->get('middleware', []));
    $myEvents->bind(\FreeFW\Constants::EVENT_ROUTE_NOT_FOUND, function () {
        //@todo
        echo "Commande introuvable\n";
    });
    $myEvents->bind(\FreeFW\Constants::EVENT_AFTER_RENDER, function () use ($app, $startTs) {
        $endTs = microtime(true);
        $diff  = $endTs - $startTs;
        $app->getLogger()->info('Total execution time : ' . $diff);
    });
    // CRUD for notifications and cache clear
    // Were not async and transactions are global and transactions start-end is linear.
    // @TODO : Send updates just on commit... or if not transaction on
    // We can use a static tables of data befofe send... or an app member...
    $myEvents->bind(
        array_merge(
            [
                \FreeFW\Constants::EVENT_STORAGE_CREATE,
                \FreeFW\Constants::EVENT_STORAGE_UPDATE,
                \FreeFW\Constants::EVENT_STORAGE_DELETE,
                \FreeFW\Constants::EVENT_STORAGE_BEGIN,
                \FreeFW\Constants::EVENT_STORAGE_COMMIT,
                \FreeFW\Constants::EVENT_STORAGE_ROLLBACK,
            ],
            $myConfig->get('event', [])
        ),
        function ($p_object, $p_event_name = null) use ($app, $myQueue, $myQueueCfg) {
            $app->listen($p_object, $myQueue, $myQueueCfg, $p_event_name, false);
        }
    );
    /**
     * FreeAsso DI
     */
    \FreeFW\DI\DI::registerDI('FreeFW', $myConfig, $myLogger);
    \FreeFW\DI\DI::registerDI('FreeAsso', $myConfig, $myLogger);
    \FreeFW\DI\DI::registerDI('FreeSSO', $myConfig, $myLogger);
    \FreeFW\DI\DI::registerDI('FreeOffice', $myConfig, $myLogger);
    /**
     * On va chercher les routes des modules, ...
     */
    $freeFWCommands     = \FreeFW\Console\FreeFW::getCommands();
    $freeSSOCommands    = \FreeSSO\Console\FreeFW::getCommands();
    $freeAssoCommands   = \FreeAsso\Console\FreeFW::getCommands();
    $freeOfficeCommands = \FreeOffice\Console\FreeFW::getCommands();
    /**
     * GO...
     */
    $app
        ->setEventManager($myEvents)
        ->addCommands($freeAssoCommands)
        ->addCommands($freeSSOCommands)
        ->addCommands($freeFWCommands)
        ->addCommands($freeOfficeCommands)
    ;
    // GO
    $app->handle(true);
    // Finish
    if ($myQueue) {
        $myQueue->close();
    }
} catch (\Exception $ex) {
    echo $ex->getMessage() . "\n";
}
