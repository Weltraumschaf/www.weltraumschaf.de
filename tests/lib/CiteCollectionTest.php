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
        $this->markTestIncomplete();
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
        $this->markTestIncomplete();
    }
}