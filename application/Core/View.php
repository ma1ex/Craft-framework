<?php

/**
 * Project: craft-framework.local;
 * File: View.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 25.10.2019, 12:57
 * Comment: Base view class
 */


namespace application\Core;


class View {

    /**
     * @var Templates path
     */
    public $path;

    public $params;

    /**
     * @var string Default layout
     */
    public $layout = 'default';

    public function __construct(array $params = []) {
        $this->params = $params;
        $this->path = $params['controller'] . '\\' . $params['action'];
        //echo $this->path;
    }

    public function render($title, $vars = []) {
        //
        ob_start();
        require '..\application\Views\\' . $this->path . '.php';
        $content = ob_get_clean();
        require '..\application\Views\layouts\\' . $this->layout . '.php';
    }
}