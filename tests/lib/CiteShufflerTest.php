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
 * @author    Weltaumschaf
 * @copyright Copyright (c) 01.12.2010, Sven Strittmatter.
 * @version   0.2
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 */

require_once 'CiteShuffler.php';

class CiteShufflerTest extends PHPUnit_Framework_TestCase {
    public function testGetCite() {
        $collection = new CiteCollection(array(
            new Cite(), new Cite(), new Cite(), new Cite(),
            new Cite(), new Cite(), new Cite(), new Cite()
        ));
        $shuffler = new CiteShuffler($collection);

        $this->assertType('Cite', $shuffler->getCite());

        $same     = 0;
        $lastCite = null;

        for ($i = 0; $i < 10; $i++) {
            $cite = $shuffler->getCite();

            if ($lastCite === $cite) {
                $same++;
            }

            $lastCite = $cite;
        }

        $this->assertTrue($same < 8, 'There should not be returned the same cite 8 times!');
    }
}