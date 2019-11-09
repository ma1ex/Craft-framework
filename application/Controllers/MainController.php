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
use application\Core\Router;

class MainController extends Controller {

    public function __construct(array $params) {
        // Инициализация базовых параметров в родительском классе
        parent::__construct($params);
        // Полный путь до контейнера шаблонов (layout)
        $this->view->setLayout('..\application\Views\layouts\default.php');
        // Инициализация модели
        $this->model = $this->getModel('application\Models', $this->params['controller']);
    }

    public function indexAction() {
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->setView('..\application\Views\\' . $this->params['action'] . '.php');
        $this->view->addHeader('css/style.css', 'css');
        $this->view->addHeader('js/app.js');
        $this->view->addHeader('css/style22.css', 'css');
        $this->view->add([
            'news' => $this->model->getAllNews(),
            'page_title' => 'Главная страница',
            'page_caption' => 'Hello, World! <br> I`m a Main page! <br><br>',
            'menu' => Router::buildMenu()
        ]);

        $arr = array_filter($this->checkACL(), function($ar) {
            return ($ar[$this->params['controller']] == $this->params['action']);
            //return ($ar['name'] == 'cat 1' AND $ar['id'] == '3');// you can add multiple conditions
        });

        //debug_p($arr);
        debug_p($arr);
        $this->view->render();

    }

    public function aboutAction() {
        $this->view->setView('..\application\Views\\' . $this->params['action'] . '.php');
        $this->view->addHeader('css/style2.css', 'css');
        $this->view->addHeader('js/app2.js');
        $this->view->add([
            'page_title' => 'Об этом сайте',
            'page_caption' => 'Страница "About"',
            'menu' => Router::buildMenu()
        ]);
        $this->view->render();
    }
}