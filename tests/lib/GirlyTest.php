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
 * @copyright Copyright (c) 03.12.2010, Sven Strittmatter.
 * @version   0.2
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 */

require_once 'girly.php';

class GirlyTest extends PHPUnit_Framework_TestCase {
    public function testFunction() {
        $this->assertEquals('', girly('/does/not/exist'));
        $this->assertEquals("<!--\n" . file_get_contents(WS_DATA_DIRECTORY . '/girly'). "\n-->\n",
                            girly(WS_DATA_DIRECTORY . '/girly'));
    }
}