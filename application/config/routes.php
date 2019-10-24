<?php

/**
 * Project: craft-framework.local;
 * File: routes.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 23.10.2019, 13:38
 * Comment:
 */

/**
 * @example ['controller' => 'controllerName',
 *          'action      => 'actionName',
 *          'namespace'  => 'app\name\Space']
 */
return [
    '' => [
        'controller' => 'main',
        'action' => 'index',
        'namespace' => 'application\Controllers'
    ],

    'about' => [
        'controller' => 'main',
        'action' => 'about',
        'namespace' => 'application\Controllers'
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
        'namespace' => 'application\Controllers\Auth'
    ],

    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
        'namespace' => 'application\Controllers\Auth'
    ],

    'news/show' => [
        'controller' => 'news',
        'action' => 'show',
        'namespace' => 'application\Controllers\News'
    ]
];