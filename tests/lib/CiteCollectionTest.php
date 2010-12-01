<?php
require_once 'CiteCollection.php';
require_once 'Cite.php';

class CiteCollectionTest extends PHPUnit_Framework_TestCase {
    public function testConstructDefault() {
        $collection = new CiteCollection();
        $this->assertEquals(0, $collection->count());
    }

    public function testConstructWithCites() {
        $collection = new CiteCollection(array(
            new Cite(), new Cite(), new Cite()
        ));
        $this->assertEquals(3, $collection->count());
    }

    public function testAdd() {
        $collection = new CiteCollection();
        $this->assertEquals(0, $collection->count());
        $collection->add(new Cite());
        $this->assertEquals(1, $collection->count());
        $collection->add(new Cite());
        $this->assertEquals(2, $collection->count());
        $collection->add(new Cite());
        $this->assertEquals(3, $collection->count());
    }

    public function testArrayAccess() {
        $cites = array(
            new Cite(), new Cite(), new Cite()
        );
        $collection = new CiteCollection($cites);
        $this->assertTrue(isset($collection[0]));
        $this->assertTrue(isset($collection[1]));
        $this->assertTrue(isset($collection[2]));
        $this->assertFalse(isset($collection[3]));
        $this->assertFalse(isset($collection[4]));

        $this->assertSame($cites[0], $collection[0]);
        $this->assertSame($cites[1], $collection[1]);
        $this->assertSame($cites[2], $collection[2]);

        $cite = new Cite();
        $collection[0] = $cite;
        $this->assertNotSame($cites[0], $collection[0]);
        $this->assertSame($cite, $collection[0]);

        unset($collection[1]);
        $this->assertEquals(2, count($collection));
    }

    public function testLoadFromXml() {
        $xml = new SimpleXMLElement(file_get_contents(WS_TESTS_FIXURES_DIRECTORY . '/cites.xml'));
        $collection = CiteCollection::loadFromXml($xml);
        $this->assertType('CiteCollection', $collection);
        $this->assertEquals(6, $collection->count());


        $this->assertEquals('Jean-Jacques Rousseau', $collection[0]->getAuthor());
        $this->assertEquals('', $collection[0]->getTitle());
        $this->assertEquals('Es ist mehr wert, jederzeit die Achtung der Menschen zu haben, als
        gelegentlich ihre Bewunderung.', $collection[0]->getText());

        $this->assertEquals('Konrad Adenauer', $collection[1]->getAuthor());
        $this->assertEquals('', $collection[1]->getTitle());
        $this->assertEquals('Machen Sie sich erst einmal unbeliebt, dann werden Sie auch ernst
        genommen.', $collection[1]->getText());

        $this->assertEquals('George Bernard Shaw', $collection[2]->getAuthor());
        $this->assertEquals('', $collection[2]->getTitle());
        $this->assertEquals('Geld: ein Mittel, um alles zu haben bis auf einen aufrichtigen Freund,
        eine uneigennützige Geliebte und eine gute Gesundheit.', $collection[2]->getText());

        $this->assertEquals('Bla', $collection[5]->getAuthor());
        $this->assertEquals('Blubb title', $collection[5]->getTitle());
        $this->assertEquals('Albert Einstein', $collection[5]->getText());
    }

    public function testToJson() {
        $collection = new CiteCollection();

        for ($i = 1; $i < 4; $i++) {
            $cite = $this->getMock('Cite', array('toJson'));
            $cite->expects($this->once())
                 ->method('toJson')
                 ->will($this->returnValue('JSON' . $i));
            $collection->add($cite);
        }
        
        $this->assertEquals("[JSON1, JSON2, JSON3]", $collection->toJson());
    }

    public function testLoadFromJson() {
        $xml = new SimpleXMLElement(file_get_contents(WS_TESTS_FIXURES_DIRECTORY . '/cites.xml'));
        $collection1 = CiteCollection::loadFromXml($xml);
        $this->assertEquals(6, $collection1->count());
        $collection2 = CiteCollection::loadFromJson($collection1->toJson());
        $this->assertType('CiteCollection', $collection2);
        $this->assertEquals(6, $collection2->count());
        $this->markTestIncomplete();
    }
}