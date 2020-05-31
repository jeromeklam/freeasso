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
    // Config
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
                $logFile = $myLogCfg['file'];
                $logFile = APP_LOG.'/websocket.log';
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
                $myEvents
            );
            \FreeFW\DI\DI::setShared('Storage::' . $key, $storage);
        }
    } else {
        throw new \FreeFW\Core\FreeFWException('No storage configuration found !');
    }
    // Micro application
    $app = \FreeFW\Application\WebSocket::getInstance($myConfig, $myLogger);
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
    /**
     *
     */
    $app->handle();
} catch (\Exception $ex) {
    var_export($ex);
}