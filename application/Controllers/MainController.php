<?php

/**
 * Project: craft-framework.local;
 * File: MainController.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 23.10.2019, 21:59
 * Comment:
 */


namespace application\Controllers;

use application\Core\Acl;
use application\Core\Controller;
use application\Core\Router;

class MainController extends Controller {

    public function __construct(array $params) {
        // Инициализация базовых параметров в родительском классе
        parent::__construct($params);
        // Имя контейнера шаблонов (layout).
        // Можно не указывать, тогда будет использоваться по умолчанию - 'default'
        //$this->view->setLayout('default');
        // Инициализация модели
        $this->model = $this->getModel('application\Models', $this->params['controller']);
        $this->view->add([
            'menu' => Router::buildMenu()
        ]);
    }

    public function indexAction() {
        Acl::check();
        // Полный путь до подключаемого шаблона и перечень пеменных для вывода
        $this->view->setView(APP_TPL_PATH . $this->params['action'] . '.php');
        $this->view->addHeader('css/style.css', 'css');
        $this->view->addHeader('js/app.js');
        $this->view->add([
            'news' => $this->model->getAllNews(),
            'page_title' => 'Главная страница',
            'page_caption' => 'Hello, World! <br> I`m a Main page! <br><br>'
        ]);
        $this->view->render();

    }

    public function aboutAction() {
        Acl::check();
        $this->view->setView(APP_TPL_PATH . $this->params['action'] . '.php');
        $this->view->addHeader('css/style.css', 'css');
        $this->view->add([
            'page_title' => 'Об этом сайте',
            'page_caption' => 'Страница "About"'
        ]);
        $this->view->render();
    }
}