<?php

/**
 * Project: craft-framework;
 * File: autoload.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 22.10.2019, 22:26
 *
 * Comment:
 */

/**
 * Autoload all framework files
 */
spl_autoload_register(function($class) {
    $path_dir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
    $path_namespace = str_replace('\\', DIRECTORY_SEPARATOR, $class . '.php');
    $path = $path_dir . $path_namespace;
    if (file_exists($path)) {
        require_once $path;
    } else {
        trigger_error('Class "' . $class . '" not found!', E_USER_ERROR);
    }
});