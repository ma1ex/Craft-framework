<?php

/**
 * Project: craft-framework.local;
 * File: Controller.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 24.10.2019, 23:15
 * Comment: Base Controller
 */

declare(strict_types = 1);


namespace application\Core;

/**
 * Class Controller - BaseController
 * @package application\Core
 */
abstract class Controller {

    /**
     * @var array Router parameters
     */
    protected $params;

    /**
     * @var \application\Core\View : View class
     */
    protected $view;

    /**
     * @var mixed : Load Model class
     */
    protected $model;

    /**
     * Controller constructor.
     * @param array $params
     */
    public function __construct(array $params) {
        /* Передача массива всех параметров объекта при его создании, таких как
           имена controller, action и namespace */
        $this->params = $params;
        /* А также эти же параметры в конструктор видов, чтобы брать пути к
           используемым шаблонам */
        $this->view = new View($params);
    }

    /**
     * Чтобы жестко не привязывать модель к контроллеру,
     * этот метод позволяет загружать любую модель по требованию
     *
     * @param string $modelName
     * @return null
     */
    public function getModel(string $modelName) {
        if (class_exists($modelName)) {
            return new $modelName(new Db());
        }
        return null;
    }

    /**
     * Загрузка модели по умолчанию в зависимости от имени контроллера,
     * в котором был вызван этот метод. Например, если имя контроллера
     * MainController, загрузится модель Main, у которой пространство имен
     * определено константой APP_MODELS_NAMESPACE в файле конфигурации.
     */
    public function loadModel(): void {
        // Разбивает строку на массив, где крайняя ячейка - имя контроллера
        $classExploded = explode('\\', debug_backtrace()[1]['class']);
        // Отделение из всего массива полного имени контроллера (класса)
        $controllerFull = array_pop($classExploded);
        // Имя контроллера без постфикса
        $controller = str_replace('Controller', '', $controllerFull);
        $model = APP_MODELS_NAMESPACE . $controller;
        if (class_exists($model)) {
            $this->model = new $model(new Db());
        }
    }

}