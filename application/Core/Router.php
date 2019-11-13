<?php

/**
 * Project: craft-framework.local;
 * File: Router.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 22.10.2019, 14:38
 * Comment: Build application routes
 */

declare(strict_types = 1);

namespace application\Core;

/**
 * Class Router
 * @package application\Core
 */
class Router {

    /**
     * @var array Routes array
     */
    protected static $routes = [];

    /**
     * @var array Parameters array
     */
    protected $params = [];

    /**
     * Router constructor.
     * @param array $routes Routes array
     */
    public function __construct(array $routes = []) {
        if (is_array($routes)) {
            /*foreach($routes as $key => $value) {
                $this->add($key, $value);
            }*/

            //$this->routes = $routes;
            self::$routes = $routes;
        }
    }

    /**
     * @param string $route Examp: 'catalog/good'
     * @param array $params Examp:
     *                              ['controller' => 'controllerName',
     *                               'action      => 'actionName',
     *                               'namespace'  => 'app\name\Space']
     */
    public function add(string $route, array $params = []) {
        // Case-sensitive
        //$route = '#^' . $route . '$#';
        // Case-insensitive
        //$route = '#^' . $route . '$#i';
        //$this->routes[$route] = $params;
        self::$routes[$route] = $params;
    }

    /**
     * @return array Return all routes
     */
    public static function getAllRoutes(): array {
        return self::$routes;
    }

    /**
     * @return mixed : Build the main menu based on the routes
     *
     * Формирование главного меню.
     * Почему именно в этом классе? Т.к. роуты загружаются из внешнего массива (файла), а не строятся динамически на основе разбора $_SERVER['REQUEST_URI'], и их анализом и построением путей занимается именно этот класс, то логичнее всего (как по мне) именно здесь формировать ссылки на все страницы, как, собственно, и в этом же классе делать карту сайта/приложения.
     *
     */
    public static function buildMenu() {
        $menu = [];
        foreach(self::getAllRoutes() as $url => $linkName) {
            $url = APP_HTTP_PATH . $url;
            $menu[$url] = $linkName['name'];
        }
        return $menu;
    }

    /**
     * @return bool Return true if route matches or false if dont matches
     */
    public function match(): bool {
        $url = $_SERVER['REQUEST_URI'];
        $url = trim($url, '/');
        foreach(self::$routes as $route => $params) {
            if(preg_match('#^' . $route . '$#i', $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * @return array Segmented URL path
     */
    public function getUrlPath(): array {
        $url = $_SERVER['REQUEST_URI'];
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = trim($url, '/');
        $url = parse_url($url, PHP_URL_PATH);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        return $url;
    }

    /**
     * Check for URL matches with the router configuration and call
     * the method in the appropriate controller
     */
    public function run(): void {
        if ($this->match()) {
            //$pathController = $this->params['namespace'] . '\\' . ucfirst($this->params['controller']) . 'Controller';
            $pathController = $this->params['namespace'] . DS . ucfirst($this->params['controller']) . 'Controller';
            if(class_exists($pathController)) {
                // Create new object
                $controller = new $pathController($this->params);
                //$controller = new $pathController($this->routes);
                $action = lcfirst($this->params['action']) . 'Action';
                // Call object method
                if(method_exists($controller, $action)) {
                    call_user_func(array($controller, $action));
                } else {
                    //trigger_error('Method "' . $action . '" not found!', E_USER_ERROR);
                    self::errorCode(404, APP_TPL_ERRORS_PATH);
                }
            } else {
                //trigger_error('Controller "' . $pathController . '" not found!', E_USER_ERROR);
                self::errorCode(404, APP_TPL_ERRORS_PATH);
            }
        } else {
            //trigger_error('URL "' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '" not exist!', E_USER_ERROR);
            //View::errorCode(404, '..\application\Views\errors\\');
            self::errorCode(404, APP_TPL_ERRORS_PATH);
        }
    }

    /**
     * @param int $code - Set status code (404, 403, etc...)
     * @param string $pathTemplate - Full path to custom error template
     */
    public static function errorCode(int $code, string $pathTemplate = '') {
        http_response_code($code);
        $template = $pathTemplate . $code . '.php';
        if (file_exists($template)) {
            require_once $template;
            exit;
        }

        switch ($code) {
            case 400:
                exit('400. Bad Request.');
                break;
            case 403:
                exit('403. Access Forbidden!');
                break;
            case 404:
                exit('404. Not found...');
                break;
        }
    }

    /**
     * @param string $url - URL to redirect
     */
    public static function redirect(string $url) {
        header('Location: ' . $url);
        exit;
    }
}