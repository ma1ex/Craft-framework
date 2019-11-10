<?php

/**
 * Project: craft-framework.local;
 * File: Acl.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 10.11.2019, 21:46
 * Comment: Base ACL (RBAC) class
 */


namespace application\Core;

class Acl {

    const ROOT  = 4; // Full access
    const ADMIN = 3; // Limited access
    const USER  = 2; // For authorized users
    const GUEST = 1; // For all as guests

    /**
     * All registered access rules
     *
     * @var array
     */
    protected static $rules = [];

    /**
     * Show details: class name and action name
     *
     * @var array
     */
    protected static $thisActionDetail = [];

    /**
     * Add single rule : 'Controller@action', accessModifier as nums: 1, 2, 3 or 4
     *
     * @param string $controllerAtAction
     * @param int $accessModifier
     */
    public static function addRule(string $controllerAtAction, int $accessModifier): void {
        self::$rules[$controllerAtAction] = $accessModifier;
    }

    /**
     * Add array rules : ['Controller@action' => accessModifier as nums: 1, 2, 3 or 4]
     *
     * @param array $rules
     */
    public static function addRules(array $rules): void {
        self::$rules = array_merge(self::$rules, $rules);
    }

    /**
     * Check access
     *
     * @return bool
     */
    public static function check(): bool {
        // Разбивает строку на массив, где крайняя ячейка - имя контроллера
        $classExploded = explode('\\', debug_backtrace()[1]['class']);
        // Отделение из всего массива полного имени контроллера (класса)
        $controllerFull = array_pop($classExploded);
        // Имя контроллера без постфикса
        $controller = str_replace('Controller', '', $controllerFull);
        // Получение полного имени экшена (метода)
        $actionFull = debug_backtrace()[1]['function'];
        // Имя экшена без постфикса
        $action = str_replace('Action', '', $actionFull);
        // Соединяет в строку оставшиеся элементы массива, чтобы получить пространство имен
        $namespace = implode('\\', $classExploded);
        self::$thisActionDetail = [
            'namespace' => $namespace,              // application\Controllers
            'controller' => $controller,            // Main
            'action' => $action,                    // index
            'controllerFull' => $controllerFull,    // MainController
            'actionFull' => $actionFull             // indexAction
        ];
        // Строка типа 'MainController@index' для поиска в массиве правил и сравнения
        $actionRule = $controllerFull . '@' . $action;
        if (array_key_exists($actionRule, self::$rules)) {
            // Если модификатор доступа для этого экшена = 1, т.е. доступ разрешен всем
            // и дальнейшие проверки не нужны
            if (self::$rules[$actionRule] === 1) {
                return true;
            }
            // Если же существует определенная сессия и ключи в ней, то валидируем ее
            if (isset($_SESSION['user']['accessLevel'])) {
                // Если уровень доступа юзера больше или равен модификатору доступа для экшена,
                // то доступ разрешаем
                if ($_SESSION['user']['accessLevel'] >= self::$rules[$actionRule]) {
                    return true;
                } else {
                    // Если все плохо, то посылаем заглловок 403
                    self::forbidden();
                }
            } else {
                // Если такой сессии нету и пройдена предыдущая проверка на общедоступный
                // ресурс (=== 1), то просто закрываем доступ
                self::forbidden();
            }
        }

        // По умолчанию доступ запрещен
        self::forbidden();
    }

    /**
     * Return all registered rules
     *
     * @return array
     */
    public static function getRules(): array {
        return self::$rules;
    }

    /**
     * Set 403 HTTP Header
     */
    protected static function forbidden(): void {
        http_response_code(403);
        $template = '..\application\Views\errors\403.php';
        if (file_exists($template)) {
            require_once $template;
            exit;
        } else {
            exit ('403. Access Forbidden!');
        }
    }
}