<?php
require_once 'WS/Model/AbstractBase.php';

abstract class BookBase extends WS_Model_AbstractBase {
    private $author;
    private $title;
    private $coverPicture;
    private $affiliateUrl;
    private $description;

    public function __construct($data = null) {
        parent::__construct(array(
            'author',
            'title',
            'coverPicture',
            'affiliateUrl',
            'description'
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

    public function setCoverPicture($value) {
        $this->coverPicture = (string) $value;
    }

    public function getCoverPicture() {
        return $this->coverPicture;
    }

    public function setAffiliateUrl($value) {
        $this->affiliateUrl = (string) $value;
    }

    public function getAffiliateUrl() {
        return $this->affiliateUrl;
    }

    public function setDescription($value) {
        $this->description = (string) $value;
    }

    public function getDescription() {
        return $this->description;
    }
}