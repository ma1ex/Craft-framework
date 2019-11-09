<?php

/**
 * Project: craft-framework.local;
 * File: acl.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 07.11.2019, 23:00
 * Comment:
 */
 
return [
    //
    'all' => [
        'main' => 'index',
        'account' => 'register'
    ],

    //
    'authorized' => [
        'controllerName' => 'methodName',
    ],

    //
    'admin' => [
        'account' => 'login',
    ],

    //
    'guest' => [
        'controllerName' => 'methodName',
    ]
];