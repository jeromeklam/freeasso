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
    /**
     * FreeAsso DI
     */
    \FreeFW\DI\DI::registerDI('FreeFW', $myConfig, $myLogger);
    \FreeFW\DI\DI::registerDI('FreeAsso', $myConfig, $myLogger);
    \FreeFW\DI\DI::registerDI('FreeSSO', $myConfig, $myLogger);
    // Listener
    $myListener = new \FreeAsso\Service\StorageListener();
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
        $channel = $myQueue->channel();
        $channel->exchange_declare($myQueueCfg['name'], 'fanout', false, false, false);
        list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);
        $channel->queue_bind($queue_name, $myQueueCfg['name']);
        
        echo " [*] Waiting for logs. To exit press CTRL+C\n";
        
        $callback = function ($msg) use ($myListener) {
            $myListener->onStorage($msg);
        };
        $channel->basic_consume($queue_name, '', false, true, false, false, $callback);
        
        while ($channel->is_consuming()) {
            $channel->wait();
        }
        $channel->close();
        $myQueue->close();
    } else {
        echo "Missing queue config !";
    }
} catch (\Exception $ex) {
    var_export($ex);
}