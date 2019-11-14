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
        $this->view->add([
            'menu' => Router::buildMenu()
        ]);
    }

    public function registerAction() {
        Acl::check();
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->setView('auth' . DS . $this->params['action']);
        $this->view->add([
            'page_title' => 'Страница регистрации',
            'page_caption' => 'Введите данные для регистрации'
        ]);
        $this->view->render();
    }

    public function loginAction() {
        Acl::check();
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->setView('auth' . DS . $this->params['action']);
        $this->view->add([
            'page_title' => 'Страница входа',
            'page_caption' => 'Введите данные, чтобы войти'
        ]);
        $this->view->render();
    }
}