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

class AccountController extends Controller {

    public function __construct(array $params) {
        parent::__construct($params);
        // Полный путь контейнера шаблонов (layout)
        $this->view->setLayout('..\application\Views\layouts\default.php');
    }

    public function registerAction() {
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->render('..\application\Views\auth\\' . $this->params['action'] . '.php', [
            'title' => 'Страница регистрации',
            'page_caption' => 'Введите данные для регистрации'
        ]);
    }

    public function loginAction() {
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->render('..\application\Views\auth\\' . $this->params['action'] . '.php', [
            'title' => 'Страница входа',
            'page_caption' => 'Введите данные, чтобы войти'
        ]);
    }
}