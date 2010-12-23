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
 * @see WS_Model_Template_Argument
 */
require_once 'WS/Model/Template/Argument.php';

/**
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */
class WS_Model_Template_Method extends WS_Model_Template_Abstract {
    /**
     * Array of WS_Model_Template_Argument objects.
     * 
     * @var array
     */
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
        return $this->hasAssignedVar('ABSTRACT');
    }

    public function setStatic($switch = true) {
        if ($switch) {
            $this->assignVar('STATIC', 'static ');
        } else {
            $this->assignVar('STATIC', '');
        }
    }

    public function isStatic() {
        return $this->hasAssignedVar('STATIC');
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