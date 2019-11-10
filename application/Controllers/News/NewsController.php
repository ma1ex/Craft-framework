<?php

/**
 * Project: craft-framework.local;
 * File: NewsController.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 24.10.2019, 23:11
 * Comment:
 */


namespace application\Controllers\News;

use application\Core\Acl;
use application\Core\Controller;
use application\Core\Router;

class NewsController extends Controller{

    public function __construct(array $params) {
        parent::__construct($params);
        $this->view->setLayout('..\application\Views\layouts\default.php');
    }

    public function showAction() {
        Acl::check();
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->setView('..\application\Views\news\\' . $this->params['action'] . '.php');
        $this->view->add([
            'page_title' => 'Страница Новостей',
            'page_caption' => 'Вывод всех новостей',
            'menu' => Router::buildMenu()
        ]);
        $this->view->render();
    }
}