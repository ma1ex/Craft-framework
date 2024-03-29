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
 * Autoload all framework classes
 */
spl_autoload_register(function($class) {
    // Current filesystem directory
    $pathDir = dirname(__DIR__) . DIRECTORY_SEPARATOR;
    // Called classes Namespace
    $pathNamespace = str_replace('\\', DIRECTORY_SEPARATOR, $class . '.php');
    $path = $pathDir . $pathNamespace;
    if (file_exists($path)) {
        require_once $path;
    } else {
        trigger_error('Class "' . $class . '" not found!', E_USER_ERROR);
    }
});