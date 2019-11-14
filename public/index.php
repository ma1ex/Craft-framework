<?php

/**
 * Project: craft-framework.local;
 * File: index.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 22.10.2019, 13:55
 * Comment: Front Controller
 */

//$memoryStart = memory_get_usage();

// Develop
require_once '../application/lib/dev.php';
// Env config
require_once '../application/config/env.php';
// Autoloader
require_once '../application/autoload.php';
// Routes config
$routes = require_once '../application/config/routes.php';

use application\Core\Router;
use application\Core\Acl;

session_start();

//debug_v($_SERVER);
//$_ENV['qwqwq'] = 'sdfsdf';
//debug_v($_ENV);
//debug_v(getenv('ENV'));
//debug_v(APP_BASE_PATH);

$router = new Router($routes);
//$router->add('test/test', 'qwerty');
//debug_p($router->getAllRoutes());
//debug_p($router->getUrlPath());

/*
 * ROOT  = 4;
 * ADMIN = 3;
 * USER  = 2;
 * GUEST = 1;
*/
$_SESSION['user']['accessLevel'] = 4;
Acl::addRule('AccountController@login', 3);
Acl::addRules([
    'MainController@index' => 1,
    'MainController@about' => 4,
    'AccountController@register' => 2,
    'NewsController@show' => 3,
]);

$router->run();


//debug_p($_SERVER);

//echo convert(memory_get_usage() - $memoryStart);
getMemory('peak');
getMemory();