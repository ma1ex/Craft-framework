<?php

/**
 * Project: craft-framework.local;
 * File: env.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 12.11.2019, 23:30
 * Comment: Environment config
 */

// Example: http://this-site-domain/
if (!defined('APP_HTTP_PATH')) {
    define('APP_HTTP_PATH', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/');
}

//
if (!defined('APP_TPL_PATH')) {
    define('APP_TPL_PATH', '..\application\Views\\');
}

//
if (!defined('APP_TPL_ERRORS_PATH')) {
    define('APP_TPL_ERRORS_PATH', '..\application\Views\errors\\');
}
 