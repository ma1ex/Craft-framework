<?php

/**
 * Project: craft-framework.local;
 * File: Controller.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 24.10.2019, 23:15
 * Comment: Base controller
 */


namespace application\Core;

use application\Core\View;

/**
 * Class Controller - BaseController
 * @package application\Core
 */
abstract class Controller {

    /**
     * @var array Router parameters
     */
    protected $params;

    protected $view;

    /**
     * Controller constructor.
     * @param array $params
     */
    public function __construct(array $params) {
        $this->params = $params;
        $this->view = new View($params);
    }
}