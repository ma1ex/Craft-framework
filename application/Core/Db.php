<?php

/**
 * Project: craft-framework.local;
 * File: Db.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 28.10.2019, 20:13
 * Comment:
 */


namespace application\Core;

use PDO;

class Db {

    /**
     * @var PDO|null
     */
    protected $db;

    public function __construct() {
        $file = '../application/config/db.php';
        if (file_exists($file)) {
            $config = require_once $file;
        }

        $this->db = $this->getConnect($config);

    }

    /**
     * @param array $config
     * @return PDO|null
     */
    public function getConnect(array $config) {
        if (is_array($config)) {
            extract($config);
        } else {
            trigger_error('"' . $config . '" is not Array!', E_USER_ERROR);
        }
        $dsn = "mysql:host=" . $host . ";dbname=" . $name . ";charset=" . $charset . "";
        $options = array (
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::MYSQL_ATTR_FOUND_ROWS => true
        );
        try {
            return new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return null;
    }
}