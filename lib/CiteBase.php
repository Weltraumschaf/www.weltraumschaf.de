<?php
require_once 'WS/Model/AbstractBase.php';

abstract class CiteBase extends WS_Model_AbstractBase {
    private $author;
    private $title;
    private $text;

    public function __construct($data = null) {
        parent::__construct(array(
            'author',
            'title',
            'text'
        ), $data);
    }

    public function setAuthor($value) {
        $this->author = (string) $value;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setTitle($value) {
        $this->title = (string) $value;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setText($value) {
        $this->text = (string) $value;
    }

    public function getText() {
        return $this->text;
    }
}