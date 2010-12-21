<?php
require_once 'WS/Model/Template/Abstract.php';
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