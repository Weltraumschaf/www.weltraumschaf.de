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
 * @see WS_Model_Template_Argument
 */
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