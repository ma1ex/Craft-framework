<?php

/**
 * Project: craft-framework.local;
 * File: Acl.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 10.11.2019, 21:46
 * Comment:
 */


namespace application\Core;


class Acl {

    const ROOT  = 4;
    const ADMIN = 3;
    const USER  = 2;
    const GUEST = 1;

    /**
     * All access rules
     *
     * @var array
     */
    private static $rules = [];

    /**
     * @param string $classAndMethod
     * @param int $accessModifier
     */
    public static function addRule(string $classAndMethod, int $accessModifier = 4): void {
        self::$rules[$classAndMethod] = $accessModifier;
    }

    /**
     * @param array $rules
     */
    public static function addRules(array $rules): void {
        self::$rules = array_merge(self::$rules, $rules);
    }

    public static function checkACL(): bool {
        //
    }

    /**
     * @return array
     */
    public static function getRules(): array {
        return self::$rules;
    }

    /**
     * @return array
     */
    public static function getNamesCalled(): array {
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
        return [
            'namespace' => $namespace,
            'controller' => $controller,
            'action' => $action,
            'controllerFull' => $controllerFull,
            'actionFull' => $actionFull
        ];

    }

}