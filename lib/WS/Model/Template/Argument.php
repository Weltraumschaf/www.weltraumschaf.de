<?php

require_once 'WS/Model/Template/Abstract.php';
require_once 'WS/Model/Template/Argument.php';

class WS_Model_Template_Argument extends WS_Model_Template_Abstract {
    public function setTypeHint($type) {
        $this->assignVar('TYPE_HINT', (string) $type);
    }

    public function getTypeHint() {
        return $this->getAssignedVar('TYPE_HINT');
    }

    public function setName($name) {
        $this->assignVar('NAME', (string) $name);
    }

    public function getName() {
        return $this->getAssignedVar('NAME');
    }

    public function setDefault($value) {
        $this->assignVar('DEFAULT', (string) $value);
    }

    public function render() {
        if (!$this->hasAssignedVar('NAME')) {
            throw new Exception("Does not have required variable 'NAME' assigned!");
        }

        $string = $this->readTemplate();

        if ($this->hasAssignedVar('TYPE_HINT')) {
            $string = self::replaceVarToken($string, 'TYPE_HINT',
                                            $this->getAssignedVar('TYPE_HINT') . ' ');
        } else {
            $string = self::replaceVarToken($string, 'TYPE_HINT');
        }

        $string = self::replaceVarToken($string, 'NAME', $this->getAssignedVar('NAME'));

        if ($this->hasAssignedVar('DEFAULT')) {
            $string = self::replaceVarToken($string, 'DEFAULT',
                                            ' = ' . $this->getAssignedVar('DEFAULT'));
        } else {
            $string = self::replaceVarToken($string, 'DEFAULT');
        }

        return $string;
    }
}