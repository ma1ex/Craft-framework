<?php

/**
 * Project: craft-framework.local;
 * File: View.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 25.10.2019, 12:57
 * Comment: Base view class
 */

declare(strict_types = 1);


namespace application\Core;


class View {

    /**
     * @var Template path
     */
    //public $path;

    /**
     * @var array Router parameters
     */
    public $params;

    /**
     * @var string Default layout
     */
    public $layout = 'default';

    public function __construct(array $params = []) {
        $this->params = $params;
        // Построение пути до шаблона
        //$this->path = $params['controller'] . DIRECTORY_SEPARATOR . $params['action'];
        //echo 'path: ' . $this->path . '<br>';
    }

    /**
     * @param string $layout Full path to layout file
     */
    public function setLayout(string $layout) {
        // TODO: Путь к лэйаутам перенести в конфиг!
        //$this->layout = '..\application\Views\layouts\\' . $layout  . '.php';
        $this->layout = $layout;
    }

    //public function render($title, $vars = []) {
        // Включение буферизации вывода
        //ob_start();
        /* Подключение файла шаблона, загрузка его в буфер и присвоение переменной
           $content для дальнейшего вывода в файле layout`а */
        //require '..\application\Views\\' . $this->path . '.php';
        //$content = ob_get_clean();
        /* Подключение файла layout`а и передача в него всех переменных для вывода
           контента */
        //require '..\application\Views\layouts\\' . $this->layout . '.php';
    //}

    public function render(string $templatePath, array $vars = []) {
        // Включение буферизации вывода
        ob_start();
        // Экспорт ключей массива для дальнейшего их использования по именам в шаблоне и лэйауте
        extract($vars);
        /* Подключение файла шаблона, загрузка его в буфер и присвоение переменной
           $content для дальнейшего вывода в файле layout`а */
        if (file_exists($templatePath)) {
            require $templatePath;
        } else {
            trigger_error('Template "' . $templatePath . '" not found!', E_USER_ERROR);
        }
        $content = ob_get_clean();
        /* Подключение файла layout`а и передача в него всех переменных для вывода
           контента */
        if (file_exists($this->layout)) {
            require $this->layout;
        } else {
            trigger_error('Layout "' . $this->layout . '" not found!', E_USER_ERROR);
        }
    }


    /*public static function errorCode(int $code, string $pathTemplate = '') {
        http_response_code($code);
        $template = $pathTemplate . $code . '.php';
        if (file_exists($template)) {
            require_once $template;
            exit;
        }
        exit('Not found...');
    }*/
}