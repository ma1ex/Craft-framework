<?php

/**
 * Project: craft-framework.local;
 * File: dev.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 22.10.2019, 14:19
 * Comment:
 */
 
ini_set('display_errors', 1);
error_reporting(E_ALL);

 // Debug
function debug($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit();
}