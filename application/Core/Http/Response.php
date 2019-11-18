<?php

/**
 * Project: craft-framework.local;
 * File: Response.php;
 * Developer: Matvienko Alexey (matvienko.alexey@gmail.com);
 * Date & Time: 18.11.2019, 23:34
 * Comment:
 */


namespace application\Core\Http;


class Response {
    private $headers = [];
    private $body;
    private $statusCode;
    private $reasonPhrase ='';

    private static $phrases = [
        200 => 'OK',
        301 => 'Moved Permanently',
        400 => 'Bad Request',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error'
    ];

    /**
     * Response constructor.
     * @param $body : Text
     * @param int $status : Status code
     */
    public function __construct($body, $status = 200) {
        $this->body = $body;
        $this->statusCode = $status;
    }

    /**
     * @return mixed : Return source text
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * @param $body : Source text
     * @return Response : Cloned this object
     */
    public function withBody($body): self {
        $new = clone $this;
        $new->body = $body;

        return $new;
    }

    /**
     * @return int : Status code
     */
    public function getStatusCode(): int {
        return $this->statusCode;
    }

    /**
     * @return mixed|string
     */
    public function getReasonPhrase() {
        if (!$this->reasonPhrase && isset(self::$phrases[$this->statusCode])) {
            $this->reasonPhrase = self::$phrases[$this->statusCode];
        }

        return $this->reasonPhrase;
    }

    /**
     * @param $code : Status code
     * @param string $reasonPhrase : Reason phrase
     * @return Response : This instance object
     */
    public function withStatus($code, $reasonPhrase = ''): self {
        $new = clone $this;
        $new->statusCode = $code;
        $new->reasonPhrase = $reasonPhrase;

        return $new;
    }

    /**
     * Return all headers
     *
     * @return array
     */
    public function getHeaders(): array {
        return $this->headers;
    }

    /**
     * Check header for exist
     *
     * @param $header
     * @return bool
     */
    public function hasHeader($header): bool {
        return isset($this->headers[$header]);
    }

    /**
     * @param $header
     * @return mixed|null
     */
    public function getHeader($header) {
        if (!$this->hasHeader($header)) {
            return null;
        }

        return $this->headers[$header];
    }

    /**
     * Changes the header to a new value
     *
     * @param $header
     * @param $value
     * @return Response
     */
    public function withHeader($header, $value): self {
        $new = clone $this;
        if ($new->hasHeader($header)) {
            unset($new->headers[$header]);
        }

        $new->headers[$header] = $value;

        return $new;
    }
}