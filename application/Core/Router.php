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
    protected $routes = [];

    /**
     * @var array Parameters array
     */
    protected $params = [];

    /**
     * Router constructor.
     * @param array $routes Injection routes array
     */
    public function __construct(array $routes = []) {
        if (is_array($routes)) {
            /*foreach($routes as $key => $value) {
                $this->add($key, $value);
            }*/

            $this->routes = $routes;
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
        $this->routes[$route] = $params;
    }

    /**
     * @return array Return all routes
     */
    public function getAllRoutes(): array {
        return $this->routes;
    }

    /**
     * @return bool Return true if route matches or false if dont matches
     */
    public function match(): bool {
        $url = $_SERVER['REQUEST_URI'];
        $url = trim($url, '/');
        foreach($this->routes as $route => $params) {
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
    public function run() {
        //debug_v($this->routes);
        if ($this->match()) {
            $pathController = $this->params['namespace'] . '\\' . ucfirst($this->params['controller']) . 'Controller';
            if(class_exists($pathController)) {
                // Create new object
                $controller = new $pathController($this->params);
                //$controller = new $pathController($this->routes);
                $action = lcfirst($this->params['action']) . 'Action';
                // Call object method
                if(method_exists($controller, $action)) {
                    call_user_func(array($controller, $action));
                } else {
                    trigger_error('Method "' . $action . '" not found!', E_USER_ERROR);
                }
            } else {
                trigger_error('Controller "' . $pathController . '" not found!', E_USER_ERROR);
            }
        } else {
            trigger_error('URL "' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '" not exist!', E_USER_ERROR);
        }
    }
}