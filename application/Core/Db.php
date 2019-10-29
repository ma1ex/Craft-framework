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

    /**
     * @var \PDOStatement
     */
    private $query;

    /**
     * Db constructor.
     */
    public function __construct() {
        $file = '../application/config/db.php';
        if (file_exists($file)) {
            $config = require_once $file;
        }

        $this->db = $this->getConnect($config);
    }

    /**
     * @param array $config : Connect config['host', 'name', 'user', 'password', 'charset']
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

    /**
     * @param string $sql : SQL expression
     * @param array $args : PDOStatement arguments for binding
     * @return $this
     */
    public function query(string $sql, array $args = []) {
        $statement = $this->db->prepare($sql);
        if (!empty($args)) {
            foreach($args as $key => $value) {
                $statement->bindValue(':' . $key, $value);
            }
        }
        $statement->execute();
        $this->query = $statement;

        return $this;
    }

    /**
     * @param string $query : SQL expression
     * @param array $args : PDOStatement arguments for binding
     * @return array
     */
    public function getAll($query = '', array $args = []) {
        if (!empty($query)) {
            $this->query($query, $args);
        }
        return $this->query->fetchAll();
    }

    /**
     * @param string $query : SQL expression
     * @param array $args : PDOStatement arguments for binding
     * @return mixed
     */
    public function getColumn($query = '', array $args = []) {
        if (!empty($query)) {
            $this->query($query, $args);
        }
        return $this->query->fetchColumn();
    }

}