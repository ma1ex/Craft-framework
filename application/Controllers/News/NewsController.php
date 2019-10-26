<?php

/**
 * Project: craft-framework.local;
 * File: NewsController.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 24.10.2019, 23:11
 * Comment:
 */


namespace application\Controllers\News;

use application\Core\Controller;

class NewsController extends Controller{

    public function __construct(array $params) {
        parent::__construct($params);
        $this->view->setLayout('..\application\Views\layouts\default.php');
    }

    public function showAction() {
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->render('..\application\Views\news\\' . $this->params['action'] . '.php', [
            'title' => 'Страница Новостей',
            'page_caption' => 'Вывод всех новостей'
        ]);
    }
}