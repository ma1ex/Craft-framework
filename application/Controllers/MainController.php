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

    public function __construct(array $params) {
        parent::__construct($params);
        // Полный путь контейнера шаблонов (layout)
        $this->view->setLayout('..\application\Views\layouts\default.php');
    }

    public function indexAction() {
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->render('..\application\Views\\' . $this->params['action'] . '.php', [
            'title' => 'Главная страница',
            'page_caption' => 'Hello, World! <br> I`m a Main page! <br><br>'
        ]);
    }

    public function aboutAction() {
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->render('..\application\Views\\' . $this->params['action'] . '.php', [
            'title' => 'Об этом сайте',
            'page_caption' => 'Страница "About"'
        ]);
    }
}