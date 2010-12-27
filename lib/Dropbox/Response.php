<?php

class Dropbox_Response {
    private $httpStatus;
    private $body;

    public function __construct($httpStatus, $body = null) {
        $this->httpStatus = (int) $httpStatus;

        if (null !== $body) {
            $this->body = (string) $body;
        }
    }

    public function getStatus() {
        return $this->httpStatus;
    }

    public function getBody() {
        return $this->body;
    }
}