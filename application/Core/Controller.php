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
     * @var array : ACL
     */
    protected $acl;

    /**
     * Controller constructor.
     * @param array $params
     */
    public function __construct(array $params) {
        /* Передача массива всех параметров объекта при его создании, таких как
           controller, action, namespace */
        $this->params = $params;
        /* А также эти же параметры в конструктор видов, чтобы брать пути к
           используемым шаблонам */
        $this->view = new View($params);
        //
        //$this->checkACL();

    }

    /**
     * @param string $namespaceModel
     * @param string $nameModel
     * @return Db | false
     */
    public function getModel(string $namespaceModel, string $nameModel) {
        $pathModel = $namespaceModel . '\\' . ucfirst($nameModel);
        if (class_exists($pathModel)) {
            return new $pathModel(new Db());
        }
        return false;
    }

    //public function checkACL(array $acl = []) {
    public function checkACL() {

        // TODO: переместить в конфиг!
        if (file_exists('..\application\config\acl.php')) {
            $this->acl = (array) require_once '..\application\config\acl.php';
            //$this->acl = $acl;
        }

        return $this->acl;

    }
}