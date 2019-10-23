<?php

/**
 * Project: craft-framework.local;
 * File: Router.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 22.10.2019, 14:38
 * Comment: Build application routes
 */

declare(strict_types = 1);

namespace application\core;

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
    public function __construct(array $routes) {
        if (is_array($routes)) {
            foreach($routes as $key => $value) {
                $this->add($key, $value);
            }

            //$this->routes = $routes;
        }
    }

    public function add($route, $params) {
        // Case-sensitive
        //$route = '#^' . $route . '$#';
        // Case-insensitive
        $route = '#^' . $route . '$#i';
        $this->routes[$route] = $params;
    }

    public function addRoute(string $route, array $params) {
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
    public function match() {
        $url = $_SERVER['REQUEST_URI'];
        $url = trim($url, '/');
        foreach($this->routes as $route => $params) {
            if(preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function getUrlPath(): array {
        $url = $_SERVER['REQUEST_URI'];
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = trim($url, '/');
        $url = parse_url($url, PHP_URL_PATH);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        return $url;
    }

    public function run() {
        if ($this->match()) {
            $controller = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if(class_exists($controller)) {
                new $controller;
            }
        }
    }
}