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

require_once dirname(__DIR__) . '/htdocs/inc/bootstrap.php';

/**
 * Directory where the fixture files live.
 */
define('WS_TESTS_FIXURES_DIRECTORY', WS_ROOT_DIRECTORY . '/tests/fixtures');

PHP_CodeCoverage_Filter::getInstance()->addDirectoryToBlacklist(
    PEAR_INSTALL_DIR, '.php'
);
PHP_CodeCoverage_Filter::getInstance()->addDirectoryToBlacklist(
    PHP_LIBDIR, '.php'
);
PHP_CodeCoverage_Filter::getInstance()->addDirectoryToBlacklist(
    WS_ROOT_DIRECTORY . '/lib/WS', '.php'
);
PHP_CodeCoverage_Filter::getInstance()->addFileToBlacklist(
    __FILE__
);

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
    WS_ROOT_DIRECTORY . '/tests',
    get_include_path()
)));