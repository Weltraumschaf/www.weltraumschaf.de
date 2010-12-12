<?php
/**
 * LICENSE
 *
 * "THE BEER-WARE LICENSE" (Revision 42):
 * "Sven Strittmatter" <ich@weltraumschaf.de> wrote this file.
 * As long as you retain this notice you can do whatever you want with
 * this stuff. If we meet some day, and you think this stuff is worth it,
 * you can buy me a beer in return.
 *
 * @author    Weltraumschaf
 * @copyright Copyright (c) 01.12.2010, Sven Strittmatter.
 * @version   0.2
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 */

require_once 'Jsonable.php';
require_once 'AbstractModel.php';

class Cite extends AbstractModel implements Jsonable {
    /**
     * @var string
     */
    private $author = '';
    /**
     * @var string
     */
    private $title  = '';
    /**
     * @var string
     */
    private $text   = '';

    public function setAuthor($name) {
        $this->author = $this->sanitize($name);
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setTitle($title) {
        $this->title = $this->sanitize($title);
    }

    public function getTitle() {
        return $this->title;
    }

    public function hasTitle() {
        return !empty($this->title);
    }

    public function setText($text) {
        $this->text = $this->sanitize($text);
    }

    public function getText() {
        return $this->text;
    }

    public function  toJson() {
        return $this->generateJson(array('author', 'title', 'text'));
    }
}