<?php

/**
 * Project: craft-framework.local;
 * File: View.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 25.10.2019, 12:57
 * Comment: Base View class
 */

declare(strict_types = 1);


namespace application\Core;


class View {

    /**
     * @var array : Router parameters
     */
    protected $routeParams;

    /**
     * @var array : Template vars
     */
    protected $data = [];

    /**
     * @var string : Name or path to layout file
     */
    protected $layout = APP_TPL_LAYOUTS_PATH . 'default.php';

    /**
     * @var string : Name or path to template file
     */
    protected $view = APP_TPL_PATH . 'index.php';

    public function __construct(array $routeParams = []) {
        // Init base params
        $this->setParams($routeParams);
        $this->add(['headers' => '']);
    }

    /**
     * @param string $layout Full path to layout file
     */
    public function setLayout(string $layout): void {
        $this->layout = APP_TPL_LAYOUTS_PATH . $layout  . '.php';
    }

    /**
     * @return string : Return path to layout
     */
    public function getLayout(): string {
        return $this->layout;
    }

    /**
     * @param string $view : Set template
     */
    public function setView(string $view): void {
        $this->view = APP_TPL_PATH . $view . '.php';
    }

    /**
     * @return string : Return path to view
     */
    public function getView(): string {
        return $this->view;
    }

    /**
     * @param string $incResource
     * @param string $type
     */
    public function addHeader(string $incResource, string $type = 'js'): void {
        static $resource = '';
        switch ($type) {
            case 'css':
                $resource .= '<link rel="stylesheet" href="' . $incResource . '">' . "\r\n";
                break;
            case 'js':
                $resource .= '<script src="' . $incResource .'"></script>' . "\r\n";
                break;
            default:
                $resource .= $incResource . "\r\n";
        }

        $this->add(['headers' => $resource]);
    }

    /**
     * @param array $params
     */
    public function setParams(array $params): void {
        if (is_array($params)) {
            $this->routeParams = $params;
        }
    }

    /**
     * @return array : Route params
     */
    public function getParams(): array {
        return $this->routeParams;
    }

    /**
     * @param array $vars : Template vars = ['key' => 'param']
     */
    public function add(array $vars) {
        if (is_array($vars)) {
            $this->data = array_merge($this->data, $vars);
        }
    }

    /**
     * @return array : Return all template vars
     */
    public function getVars() {
        return $this->data;
    }

    /**
     * Output all view data: layout, template and template variables
     */
    public function render(): void {
        // Включение буферизации вывода
        ob_start();
        // Экспорт ключей массива для дальнейшего их использования по именам в шаблоне и лэйауте
        extract($this->getVars());
        /* Подключение файла шаблона, загрузка его в буфер и присвоение переменной
           $content для дальнейшего вывода в файле layout`а */
        if (file_exists($this->getView())) {
            require $this->getView();
        } else {
            trigger_error('Template "' . $this->getView() . '" not found!', E_USER_ERROR);
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

}