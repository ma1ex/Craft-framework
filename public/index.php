<?php

/**
 * Project: craft-framework.local;
 * File: index.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 22.10.2019, 13:55
 * Comment:
 */

// Develop
require_once '../application/lib/dev.php';
// Autoloader
require_once '../application/autoload.php';

use application\core\Router;

echo 'Hello, World! <br> I`m a FrontController! <br><br>';

$router = new Router();