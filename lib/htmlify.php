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
 * @copyright Copyright (c) 02.12.2010, Sven Strittmatter.
 * @version   0.2
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 */

/**
 * @staticvar array $search
 * @staticvar array $replace
 * @param string $string
 * @return string
 */
function htmlify($string) {
    static $search  = array('ä',        'ö',      'ü',      'Ä',      'Ö',      'Ü',      'ß',
                            '...',      "'",      '"');
    static $replace = array('&auml;',   '&ouml;', '&uuml;', '&Auml;', '&Ouml;', '&Uuml;', '&szlig;',
                            '&hellip;', '&apos;', '&quot;');

    $string = (string)$string;
    $string = str_replace('&', '&amp;', $string);
    $string = str_replace($search, $replace, $string);

    return $string;
}