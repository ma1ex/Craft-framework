<?php

/**
 * Project: craft-framework.local;
 * File: routes.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 23.10.2019, 13:38
 * Comment: Routes config
 */

/**
 * @example ['controller' => 'controllerName',
 *          'action       => 'actionName',
 *          'namespace'   => 'App\Name\Space',
 *          'name'        => 'this_route_name']
 */
return [
    '' => [ // URL
        // Контроллер, который будет срабатывать на URL
        'controller' => 'main',
        // Метод контроллера
        'action' => 'index',
        // Пространство имен, откуда загружать контроллер
        'namespace' => 'application\Controllers',
        // Имя страницы для вывода в меню
        'name' => 'Main page'
    ],

    'about' => [
        'controller' => 'main',
        'action' => 'about',
        'namespace' => 'application\Controllers',
        'name' => 'About'
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
        'namespace' => 'application\Controllers\Auth',
        'name' => 'Register'
    ],

    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
        'namespace' => 'application\Controllers\Auth',
        'name' => 'Login'
    ],

    'news/show' => [
        'controller' => 'news',
        'action' => 'show',
        'namespace' => 'application\Controllers\News',
        'name' => 'News'
    ]
];