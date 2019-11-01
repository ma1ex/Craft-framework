<?php

/**
 * Project: craft-framework.local;
 * File: Model.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 01.11.2019, 23:21
 * Comment: Base Model class
 */


namespace application\Core;

use application\Core\Db;

abstract class Model {

    public $db;

    public function __construct() {
        $this->db = new Db();
        debug_v($this->db);
    }
}