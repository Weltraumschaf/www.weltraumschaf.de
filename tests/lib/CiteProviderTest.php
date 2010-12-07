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

require_once 'CiteProvider.php';
require_once 'vfsStream/vfsStream.php';

class CiteProviderTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {
        //vfsStreamWrapper::register();
        //vfsStreamWrapper::setRoot(new vfsStreamFile('/tmp'));
    }

    public function testGetCollection() {
        $this->markTestIncomplete();
    }

    public function testInvalidateCache() {
        $this->markTestIncomplete();
    }
}