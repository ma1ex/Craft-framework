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

    /**
     * @var array
     */
    private $queryParams;

    /**
     * @var null
     */
    private $parsedBody;

    /**
     * Request constructor.
     * @param array $queryParams
     * @param null $parsedBody
     */
    public function __construct(array $queryParams = [], $parsedBody = null) {
        $this->queryParams = $queryParams;
        $this->parsedBody = $parsedBody;
    }

    /**
     * @return array
     */
    public function getQueryParams(): array {
        return $this->queryParams;
    }

    /**
     * @param array $query
     * @return Request
     */
    public function withQueryParams(array $query): self {
        $new = clone $this;
        $new->queryParams = $query;

        return $new;
    }

    /**
     * @return null
     */
    public function getParsedBody() {
        return $this->parsedBody;
    }

    /**
     * @param $data
     * @return Request
     */
    public function withParsedBody($data): self {
        $this->parsedBody = $data;
        return $this;
    }
}