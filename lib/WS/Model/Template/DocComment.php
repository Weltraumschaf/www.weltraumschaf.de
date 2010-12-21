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
 * @see WS_Model_Template_Abstract
 */
require_once 'WS/Model/Template/Abstract.php';
/**
 * @see WS_Model_Template_DocComment_Argument
 */
require_once 'WS/Model/Template/DocComment/Argument.php';

class WS_Model_Template_DocComment extends WS_Model_Template_Abstract {
    protected $arguments;

    public function  __construct($tplFile) {
        parent::__construct($tplFile);
        $this->arguments = array();
    }


    public function setLongDesc($text) {
        $this->assignVar('LONG_DESC', (string) $text);
    }

    public function setShortDesc($text) {
        $this->assignVar('SHORT_DESC', (string) $text);
    }

    public function setReturn($type) {
        $this->assignVar('TYPE', (string) $type);
    }

    public function addArgument(WS_Model_Template_DocComment_Argument $a) {
        $this->arguments[] = array();
    }

    public function render() {
        // TODO
    }
}