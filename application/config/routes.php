<?php

/**
 * Project: craft-framework.local;
 * File: routes.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 23.10.2019, 13:38
 * Comment:
 */
 
return [
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'accaunt/login' => [
        'controller' => 'accaunt',
        'action' => 'login',
    ],

    'news/show' => [
        'controller' => 'news',
        'action' => 'show'
    ]
];