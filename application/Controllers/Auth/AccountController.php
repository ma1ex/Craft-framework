<?php

/**
 * Project: craft-framework.local;
 * File: AccountController.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 24.10.2019, 19:23
 * Comment:
 */


namespace application\Controllers\Auth;

use application\Core\Controller;

class AccountController extends Controller{

    public function registerAction() {
        echo 'AccountController->registerAction() called';
    }

    public function loginAction() {
        echo 'AccountController->loginAction() called';
    }
}