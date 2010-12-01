<?php
require_once 'Jsonable.php';

class Cite implements Jsonable {
    private $author = '';
    private $title  = '';
    private $text   = '';

    public function  __construct($data = null) {
        if (null !== $data) {
            if (is_array($data)) {
                $this->fromArray($data);
            } else if ($data instanceof  stdClass) {
                $this->fromObject($data);
            } else {
                throw new InvalidArgumentException("Can not handle passed argeument of type " . gettype($data) . "!");
            }
        }
    }

    public function fromArray(array $data) {
        foreach ($data as $key => $value) {
            $setterName = 'set' . ucfirst($key);
            $this->$setterName($value);
        }
    }

    public function fromObject(stdClass $data) {
        $properties = get_object_vars($data);
        $this->fromArray($properties);
    }

    public function  __call($name, $arguments) {
        throw new BadMethodCallException("Can not handle method call to '$name'!");
    }

    public function setAuthor($name) {
        $this->author = (string) $name;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setTitle($title) {
        $this->title = (string) $title;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setText($text) {
        $this->text = (string) $text;
    }

    public function getText() {
        return $this->text;
    }

    public function  toJson() {
        return "{author: '{$this->author}', title: '{$this->title}', text: '{$this->text}'}";
    }
}