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

/**
 * @param $var
 * uses var_dump()
 */
function debug_v($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    exit();
}

/**
 * @param $var
 * uses print_r()
 */
function debug_p($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    exit();
}