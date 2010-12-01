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
 * PHP version 5.3
 *
 * @category  WS
 * @package   WS_Darcs
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt The Beer-Ware License
 * @version   0.2
 * @link      http://github.com/Weltraumschaf/WS_Darcs
 */

/**
 * The root directory of the repo.
 */
define('WS_ROOT_DIRECTORY', dirname(__DIR__));

/**
 * Directory where the fixture files live.
 */
define('WS_TESTS_FIXURES_DIRECTORY', WS_ROOT_DIRECTORY . '/tests/fixtures');

/*
PHPUnit_Util_Filter::addDirectoryToFilter(PEAR_INSTALL_DIR);
PHPUnit_Util_Filter::addDirectoryToFilter(PHP_LIBDIR);
PHPUnit_Util_Filter::addFileToFilter(__FILE__, 'PHPUNIT');
*/
/*
 * Set error reporting to the level to which Console Library code must comply.
 */
error_reporting( E_ALL | E_STRICT );

/*
 * Prepend the lib/ and tests/ directories to the nclude_path. This allows the
 * tests to run out of the box and helps prevent loading other copies of the
 * framework code and tests that would supersede this copy.
 */
set_include_path(implode(PATH_SEPARATOR, array(
    WS_ROOT_DIRECTORY . '/lib',
    WS_ROOT_DIRECTORY . '/tests',
    get_include_path()
)));