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

require_once 'htmlify.php';

class HtmlifyTest extends PHPUnit_Framework_TestCase {
    public function testFunction() {
        $this->assertEquals('&auml;', htmlify('ä'));
        $this->assertEquals('&Auml;', htmlify('Ä'));

        $this->assertEquals('&ouml;', htmlify('ö'));
        $this->assertEquals('&Ouml;', htmlify('Ö'));

        $this->assertEquals('&uuml;', htmlify('ü'));
        $this->assertEquals('&Uuml;', htmlify('Ü'));

        $this->assertEquals('&szlig;', htmlify('ß'));
        $this->assertEquals('&hellip;', htmlify('...'));
        $this->assertEquals('&amp;', htmlify('&'));
        $this->assertEquals('&apos;', htmlify("'"));
        $this->assertEquals('&quot;', htmlify('"'));

        $this->assertEquals('Der &Auml;rger ist gro&szlig;, wenn man es &uuml;bertrteibt.',
                            htmlify('Der Ärger ist groß, wenn man es übertrteibt.'));
    }
}