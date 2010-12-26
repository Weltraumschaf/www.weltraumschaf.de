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
        $this->assertEquals('{"author":"","title":"","text":""}', $cite->toJson());
        $cite->setAuthor('foo');
        $cite->setTitle('bar');
        $cite->setText('baz');
        $this->assertEquals('{"author":"foo","title":"bar","text":"baz"}', $cite->toJson());
    }

    public function testHasTitle() {
        $cite = new Cite();
        $this->assertFalse($cite->hasTitle());
        $cite = new Cite(array('author' => 'foo', 'text' => 'bar'));
        $this->assertFalse($cite->hasTitle());
        $cite = new Cite(array('author' => 'foo', 'text' => 'bar', 'title' => 'baz'));
        $this->assertTrue($cite->hasTitle());
    }

    public function testBadMethodCall() {
        try {
            $cite = new Cite();
            $cite->foo();
            $this->fail('Call to unknown method should throw an exception!');
        } catch (BadMethodCallException $e) {
            $this->assertEquals("Does not recognize method with name 'foo'!", $e->getMessage());
        }

        try {
            $cite = new Cite(array('foo' => 'bar'));
            $this->fail('Construct with unknown property should throw an exception!');
        } catch (InvalidArgumentException $e) {
            $this->assertEquals('Can not set property \'foo\'!', $e->getMessage());
        }
    }

    public function testSanitize() {
        $cite = new Cite();
        $this->assertEquals('A string with linebreaks.',
                            $cite->sanitize("  A \tstring with\nlinebreaks.   "));
    }

    public function testInitWithConstructorData() {
        $cite = new Cite();
        $this->assertEquals('', $cite->getAuthor());
        $this->assertEquals('', $cite->getText());
        $this->assertEquals('', $cite->getTitle());

        $cite = new Cite(array(
            'author' => '  Foo  Bar  ',
            'text'   => "  A \tstring with\nlinebreaks.   ",
            'title'  => 'A Title'));
        $this->assertEquals('Foo Bar', $cite->getAuthor());
        $this->assertEquals('A string with linebreaks.', $cite->getText());
        $this->assertEquals('A Title', $cite->getTitle());

        $data = new stdClass();
        $data->author = '  Foo  Bar  ';
        $data->text   = "  A \tstring with\nlinebreaks.   ";
        $cite = new Cite($data);
        $this->assertEquals('Foo Bar', $cite->getAuthor());
        $this->assertEquals('A string with linebreaks.', $cite->getText());
        $this->assertEquals('', $cite->getTitle());
    }
}