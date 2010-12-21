<?php
require_once 'WS/Model/Template/Abstract.php';
require_once 'WS/Model/Template/Argument.php';

class WS_Model_Template_Method extends WS_Model_Template_Abstract {
    private $arguments;

    public function  __construct($tplFile) {
        parent::__construct($tplFile);
        $this->arguments = array();
    }

    public function setModifier($modifier) {
        $this->expectValidModifier($modifier);
        $this->assignVar('MODIFIER', (string) $modifier);
    }
    
    public function getModifier() {
        return $this->getAssignedVar('MODIFIER');
    }

    public function setName($name) {
        $this->assignVar('NAME', (string) $name);
    }

    public function getName() {
        return $this->getAssignedVar('NAME');
    }

    public function setAbstract($switch = true) {
        if ($switch) {
            $this->assignVar('ABSTRACT', 'abstract ');
        } else {
            $this->assignVar('ABSTRACT', '');
        }
    }

    public function isAbstract() {
        return $this->hasAssignedVar('ABSTRACT') && '' !== $this->getAssignedVar('ABSTRACT');
    }

    public function setStatic($switch = true) {
        if ($switch) {
            $this->assignVar('STATIC', 'static ');
        } else {
            $this->assignVar('STATIC', '');
        }
    }

    public function addArgument(WS_Model_Template_Argument $a) {
        $this->arguments[] = $a;
    }

    public function getArguments() {
        return $this->arguments;
    }

    public function countArguments() {
        return count($this->arguments);
    }

    public function setBody($body) {
        $this->assignVar('BODY', $body);
    }

    public function getBody() {
        return $this->getAssignedVar('BODY');
    }

    public function render() {
        if (!$this->hasAssignedVar('NAME')) {
            throw new Exception("Does not have required variable 'NAME' assigned!");
        }

        if (!$this->hasAssignedVar('MODIFIER')) {
            throw new Exception("Does not have required variable 'MODIFIER' assigned!");
        }

        $string = $this->readTemplate();
        $string = self::replaceVarToken($string, 'MODIFIER', $this->getModifier());
        $string = self::replaceVarToken($string, 'STATIC', $this->getAssignedVar('STATIC'));
        $string = self::replaceVarToken($string, 'ABSTRACT', $this->getAssignedVar('ABSTRACT'));
        $string = self::replaceVarToken($string, 'NAME', $this->getName());

        $argString = '';

        if (!empty($this->arguments)) {
            foreach ($this->arguments as $index => $argument) {
                if ($index > 0) {
                    $argString .= ', ';
                }

                $argString .= $argument->render();
            }
        }

        $string = self::replaceVarToken($string, 'ARGUMENTS', $argString);

        if ($this->isAbstract()) {
            // strip of function body
            $string = substr($string, 0, strpos($string, ')') + 1) . ';';
        } else {
            $body = '';

            if ($this->hasAssignedVar('BODY')) {
                $body = $this->getAssignedVar('BODY');
            }
            
            $string = self::replaceVarToken($string, 'BODY', $body);
        }

        return $string;
    }
}