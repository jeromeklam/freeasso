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

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use FreeWS\Test\Chat;

require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
            )
        ),
    8080
    );

$server->run();