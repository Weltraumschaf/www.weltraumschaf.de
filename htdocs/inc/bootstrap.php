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

error_reporting( E_ALL | E_STRICT );

/**
 * The root directory of the repo.
 */
define('WS_ROOT_DIRECTORY', dirname(dirname(__DIR__)));
define('WS_DATA_DIRECTORY', WS_ROOT_DIRECTORY . '/data');
define('WS_STAGE', '');

/*
 * Prepend the lib/ and tests/ directories to the nclude_path. This allows the
 * tests to run out of the box and helps prevent loading other copies of the
 * framework code and tests that would supersede this copy.
 */
set_include_path(implode(PATH_SEPARATOR, array(
    WS_ROOT_DIRECTORY . '/lib',
    get_include_path()
)));

require_once 'girly.php';
require_once 'htmlify.php';