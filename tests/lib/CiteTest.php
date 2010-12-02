<?php
require_once 'Cite.php';

class CiteTest extends PHPUnit_Framework_TestCase {
    public function testConstructWithDefaults() {
        $cite = new Cite();
        $this->assertEquals('', $cite->getAuthor());
        $this->assertEquals('', $cite->getTitle());
        $this->assertEquals('', $cite->getText());
    }

    public function testConstructWithArray() {
        $data = array(
            'author' => 'foo bar',
            'title'  => 'SNAFU',
            'text'   => 'Sitation Normal All Fucked Up'
        );
        $cite = new Cite($data);
        $this->assertEquals($data['author'], $cite->getAuthor());
        $this->assertEquals($data['title'], $cite->getTitle());
        $this->assertEquals($data['text'], $cite->getText());

        $data = array(
            'author' => 'bla blub',
            'text'   => 'Sitation Normal All Fucked Up'
        );
        $cite = new Cite($data);
        $this->assertEquals($data['author'], $cite->getAuthor());
        $this->assertEquals('', $cite->getTitle());
        $this->assertEquals($data['text'], $cite->getText());
    }

    public function testConstructWithObject() {
        $data = new stdClass();
        $data->author = 'foo bar';
        $data->title  = 'SNAFU';
        $data->text   = 'Sitation Normal All Fucked Up';
        $cite = new Cite($data);
        $this->assertEquals($data->author, $cite->getAuthor());
        $this->assertEquals($data->title, $cite->getTitle());
        $this->assertEquals($data->text, $cite->getText());
    }

    public function testToJson() {
        $cite = new Cite();
        $this->assertEquals('{"author": "", "title": "", "text": ""}', $cite->toJson());
        $cite->setAuthor('foo');
        $cite->setTitle('bar');
        $cite->setText('baz');
        $this->assertEquals('{"author": "foo", "title": "bar", "text": "baz"}', $cite->toJson());
    }
}