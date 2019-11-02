<?php

/**
 * Project: craft-framework.local;
 * File: Model.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 01.11.2019, 23:21
 * Comment: Base Model class
 */


namespace application\Core;

abstract class Model {

    /**
     * @var Db
     */
    protected $db;

    /**
     * Model constructor.
     * @param Db $db : Injection DataBase Driver
     */
    public function __construct(Db $db) {
        $this->db = $db;
    }
}