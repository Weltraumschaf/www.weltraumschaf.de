<?php
require_once 'Cite.php';

class CiteTest extends PHPUnit_Framework_TestCase {
    public function testConstructwithArray() {
        $data = array(
            'author' => 'foo bar',
            'title'  => 'SNAFU',
            'text'   => 'Sitation Normal All Fucked Up'
        );
        $cite = new Cite($data);
        $this->assertEquals($data['author'], $cite->getAuthor());
        $this->assertEquals($data['title'], $cite->getTitle());
        $this->assertEquals($data['text'], $cite->getTitle());

        $data = array(
            'author' => 'bla blub',
            'text'   => 'Sitation Normal All Fucked Up'
        );
        $cite = new Cite($data);
        $this->assertEquals($data['author'], $cite->getAuthor());
        $this->assertEquals('', $cite->getTitle());
        $this->assertEquals($data['text'], $cite->getTitle());
    }

    public function testConstructWithObject() {
        $this->markTestIncomplete();
    }

    public function testToJson() {
        $this->markTestIncomplete();
    }
}