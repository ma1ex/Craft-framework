<?php

/**
 * Project: craft-framework.local;
 * File: Request.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 14.11.2019, 22:53
 * Comment:
 */


namespace application\Core\Http;


class Request {

    public function getQueryParams(): array {
        return $_GET;
    }

    public function getParsedBody() {
        return $_POST ?: null;
    }

}