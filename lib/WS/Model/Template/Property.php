<?php
/**
 * ws-model
 *
 * LICENSE
 *
 * "THE BEER-WARE LICENSE" (Revision 42):
 * "Sven Strittmatter" <ich@weltraumschaf.de> wrote this file.
 * As long as you retain this notice you can do whatever you want with
 * this stuff. If we meet some day, and you think this stuff is worth it,
 * you can buy me a beer in return.
 *
 * PHP version 5
 *
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */

/**
 * @see WS_Model_Template_Abstract
 */
require_once 'WS/Model/Template/Abstract.php';

/**
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */
class WS_Model_Template_Property extends WS_Model_Template_Abstract {
    public function setModifier($modifier) {
        $this->expectValidModifier($modifier);
        $this->assignVar('MODIFIER', (string) $modifier);
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

        if (!$this->hasAssignedVar('MODIFIER')) {
            throw new Exception("Does not have required variable 'MODIFIER' assigned!");
        }

        $string = $this->readTemplate();
        $string = self::replaceVarToken($string, 'MODIFIER', $this->getAssignedVar('MODIFIER'));
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