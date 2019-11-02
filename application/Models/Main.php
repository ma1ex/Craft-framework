<?php

/**
 * Project: craft-framework.local;
 * File: Main.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 01.11.2019, 23:11
 * Comment:
 */


namespace application\Models;

use application\Core\Model;

class Main extends Model {

    public function getAllNews() {
        //$params = ['id' => 1];
        //$var = $db->query('SELECT name FROM users WHERE id = :id', $params)->getColumn();
        //$var = $this->db->query('SELECT name, email FROM users')->getAll();
        //$db->query('SELECT name FROM users WHERE id = :id', $params);
        //$var = $db->getColumn();

        return $this->db->query('SELECT * FROM news')->getAll();
    }
}