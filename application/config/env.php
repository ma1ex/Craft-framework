<?php

/**
 * Project: craft-framework.local;
 * File: env.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 12.11.2019, 23:30
 * Comment: Environment config
 */

// Application directory names
$names = [
    'models' => 'Models', // Name of the directory with Models
    'controllers' => 'Controllers', // Name of the directory with Controllers
    'views' => 'Views', // Name of the directory with Views
    'errors' => 'errors', // Name of the directory with Views/errors
    'libs' => 'lib' // Name of the directory with third-party libraries
];

/* =============================================================================
 * =============================================================================
 * =============================================================================
 */

// Abbreviated
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

// Example: http://this-site-domain.com/
if (!defined('APP_HTTP_PATH')) {
    define('APP_HTTP_PATH', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/');
}

// View directory
if (!defined('APP_TPL_PATH')) {
    define('APP_TPL_PATH', dirname(__DIR__) . DS . $names['views'] . DS);
}

// Errors view directory
if (!defined('APP_TPL_ERRORS_PATH')) {
    define('APP_TPL_ERRORS_PATH', APP_TPL_PATH . $names['errors'] . DS);
}
 