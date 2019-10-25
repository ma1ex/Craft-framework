<?php

/**
 * Project: craft-framework.local;
 * File: MainController.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 23.10.2019, 21:59
 * Comment:
 */


namespace application\Controllers;

use application\Core\Controller;

class MainController extends Controller{

    public function indexAction() {
        //echo 'MainController->indexAction() called';
        $this->view->render('Main page');
    }

    public function aboutAction() {
        echo 'MainController->aboutAction() called';
    }
}