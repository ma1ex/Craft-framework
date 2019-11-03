<?php

/**
 * Project: craft-framework.local;
 * File: index.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 22.10.2019, 13:55
 * Comment: Front Controller
 */

//$memoryStart = memory_get_usage();

if (!defined('APP_HTTP_PATH')) {
    define('APP_HTTP_PATH', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/');
}

// Develop
require_once '../application/lib/dev.php';
// Autoloader
require_once '../application/autoload.php';
// Routes config
$routes = require_once '../application/config/routes.php';

use application\Core\Router;

session_start();

$router = new Router($routes);
//$router->add('test/test', 'qwerty');
//debug_p($router->getAllRoutes());
//debug_p($router->getUrlPath());

$router->run();

//debug_p($_SERVER);

//echo convert(memory_get_usage() - $memoryStart);
getMemory('peak');
getMemory();