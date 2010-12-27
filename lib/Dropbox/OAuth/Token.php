<?php

class Dropbox_OAuth_Token {
    private $token;
    private $secret;

    public function __construct($token, $secret) {
        $this->token  = (string) $token;
        $this->secret = (string) $secret;
    }

    public function getToken() {
        return $this->token;
    }

    public function getSecret() {
        return $this->secret;
    }
}
