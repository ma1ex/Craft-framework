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

    /**
     * @var array : Main menu
     */
    private $menu = [];

    public function __construct(array $params) {
        // Инициализация базовых параметров в родительском классе
        parent::__construct($params);
        // Полный путь до контейнера шаблонов (layout)
        $this->view->setLayout('..\application\Views\layouts\default.php');
        // Инициализация модели
        $this->model = $this->getModel('application\Models', $this->params['controller']);

        // Формирование главного меню
        $allRoutes = Router::getAllRoutes();
        foreach($allRoutes as $link => $name) {
            if($link === '') {
                $link = '/';
            }
            $this->menu[$link] = $name['name'];
        }
    }

    public function indexAction() {
        $templateVars['news'] = $this->model->getAllNews();
        $templateVars['page_title'] = 'Главная страница';
        $templateVars['page_caption'] = 'Hello, World! <br> I`m a Main page! <br><br>';
        $templateVars['menu'] = $this->menu;

        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->render('..\application\Views\\' . $this->params['action'] . '.php', $templateVars);
    }

    public function aboutAction() {
        $templateVars['page_title'] = 'Об этом сайте';
        $templateVars['page_caption'] = 'Страница "About"';
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->render('..\application\Views\\' . $this->params['action'] . '.php', $templateVars);
    }
}