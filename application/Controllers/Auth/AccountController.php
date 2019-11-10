<?php

/**
 * Project: craft-framework.local;
 * File: AccountController.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 24.10.2019, 19:23
 * Comment:
 */


namespace application\Controllers\Auth;

use application\Core\Acl;
use application\Core\Controller;
use application\Core\Router;

class AccountController extends Controller {

    public function __construct(array $params) {
        parent::__construct($params);
        // Полный путь контейнера шаблонов (layout)
        $this->view->setLayout('..\application\Views\layouts\default.php');
    }

    public function registerAction() {
        Acl::check();
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->setView('..\application\Views\auth\\' . $this->params['action'] . '.php');
        $this->view->add([
            'page_title' => 'Страница регистрации',
            'page_caption' => 'Введите данные для регистрации',
            'menu' => Router::buildMenu()
        ]);
        $this->view->render();
    }

    public function loginAction() {
        Acl::check();
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->setView('..\application\Views\auth\\' . $this->params['action'] . '.php');
        $this->view->add([
            'page_title' => 'Страница входа',
            'page_caption' => 'Введите данные, чтобы войти',
            'menu' => Router::buildMenu()
        ]);
        $this->view->render();
    }
}