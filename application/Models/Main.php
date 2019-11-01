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
use application\Core\Db;

class Main extends Model {

    public function getUsers() {
        $this->db->query('SELECT name, email FROM users')->getAll();
    }
}