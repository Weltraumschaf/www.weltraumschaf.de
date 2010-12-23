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
 * @see WS_Model_Template_Property
 */
require_once 'WS/Model/Template/Property.php';
/**
 * @see WS_Model_Template_Method
 */
require_once 'WS/Model/Template/Method.php';

/**
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */
class WS_Model_Template_Class extends WS_Model_Template_Abstract {
    /**
     * The comment block for the class.
     * 
     * @var WS_Model_Template_DocComment
     */
    private $docComment;
    /**
     * Array of WS_Model_Template_Property objects.
     *
     * @var array
     */
    private $properties;
    /**
     * Array of WS_Model_Template_Method objects.
     *
     * @var array
     */
    private $methods;

    public function  __construct($tplFile) {
        parent::__construct($tplFile);
        $this->properties = array();
        $this->methods    = array();
    }

    /**
     *
     * @param WS_Model_Template_DocComment $dc
     */
    public function setDocComment(WS_Model_Template_DocComment $dc) {
        $this->docComment = $dc;
    }

    /**
     *
     * @return WS_Model_Template_DocComment
     */
    public function getDocComment() {
        return $this->docComment;
    }

    /**
     *
     * @return bool
     */
    public function hasDocComment() {
        return null !== $this->docComment;
    }

    /**
     *
     * @param string $name
     */
    public function setName($name) {
        $this->assignVar('NAME', (string) $name);
    }

    /**
     *
     * @return string
     */
    public function getName() {
        return $this->getAssignedVar('NAME');
    }

    /**
     *
     * @param string $className
     */
    public function setBaseClass($className) {
        $this->assignVar('BASE_CLASS_NAME', (string) $className);
    }

    /**
     *
     * @return string
     */
    public function getBaseClass() {
        return $this->getAssignedVar('BASE_CLASS_NAME');
    }

    /**
     *
     * @return bool
     */
    public function hasBaseClass() {
        if (!$this->hasAssignedVar('BASE_CLASS_NAME')) {
            return false;
        }

        return '' !== $this->getAssignedVar('BASE_CLASS_NAME');
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

    public function addProperty(WS_Model_Template_Property $p) {
        $this->properties[$p->getName()] = $p;
    }

    /**
     *
     * @return int
     */
    public function countProperties() {
        return count($this->properties);
    }

    /**
     *
     * @return array
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     *
     * @param string $name
     * @return bool
     */
    public function hasProperty($name) {
        return array_key_exists((string) $name, $this->properties);
    }

    /**
     *
     * @param string $name
     * @return WS_Model_Template_Property
     */
    public function getProperty($name) {
        if ($this->hasProperty($name)) {
            return $this->properties[(string) $name];
        }

        return null;
    }

    /**
     *
     * @param WS_Model_Template_Method $m
     */
    public function addMethod(WS_Model_Template_Method $m) {
        $this->methods[$m->getName()] = $m;
    }

    /**
     *
     * @param string $name
     * @return bool
     */
    public function hasMethod($name) {
        return array_key_exists((string) $name, $this->methods);
    }

    /**
     *
     * @param string $name
     * @return WS_Model_Template_Method
     */
    public function getMethod($name) {
        if ($this->hasMethod($name)) {
            return $this->methods[(string) $name];
        }

        return null;
    }

    /**
     *
     * @return int
     */
    public function countMethods() {
        return count($this->methods);
    }

    /**
     *
     * @return array
     */
    public function getMethods() {
        return $this->methods;
    }

    /**
     *
     * @param string $className
     * @param string $extension
     * @return string
     */
    public static function generateFileName($className, $extension = '.php') {
        if ('.' !== $extension[0]) {
            $extension = '.' . $extension;
        }

        return str_replace('_', '/', $className) . $extension;
    }

    /**
     *
     * @return string
     */
    public function render() {
        if (!$this->hasAssignedVar('NAME')) {
            throw new Exception("Does not have required variable 'NAME' assigned!");
        }

        $string = $this->readTemplate();

        if ($this->isAbstract()) {
            $string = self::replaceVarToken($string, 'ABSTRACT', $this->getAssignedVar('ABSTRACT'));
        } else {
            $string = self::replaceVarToken($string, 'ABSTRACT');
        }

        $string = self::replaceVarToken($string, 'NAME', $this->getAssignedVar('NAME'));
        $baseClassRequireString = '';
        $baseClassExtendsString = '';

        if ($this->hasBaseClass()) {
            $baseClassName = $this->getBaseClass();
            $baseFileName  = self::generateFileName($baseClassName);
            $baseClassRequireString = "require_once '{$baseFileName}';";
            $baseClassExtendsString = " extends {$baseClassName}";
        }

        $string = self::replaceVarToken($string, 'BASE_CLASS_REQUIRE', $baseClassRequireString);
        $string = self::replaceVarToken($string, 'BASE_CLASS_NAME', $baseClassExtendsString);
        $docCommentString = '';

        if ($this->hasDocComment()) {
            $docCommentString = $this->getDocComment()->render();
        }

        $string = self::replaceVarToken($string, 'DOC_COMMENT', $docCommentString);
        $proertiesString = '';
        
        if ($this->countProperties()) {
            $index= 0;
            foreach ($this->getProperties() as $property) {
                if ($index > 0) {
                    $proertiesString .= "\n";
                }
                
                $proertiesString .= self::getIndentation() . $property->render();
                $index++;
            }

            if ($this->countMethods()) {
                $proertiesString .= "\n";
            }
        }
        
        $string = self::replaceVarToken($string, 'PROPERTIES', $proertiesString);
        $methodsString = '';

        if ($this->countMethods()) {
            $index = 0;
            foreach ($this->getMethods() as $method) {
                if ($index > 0) {
                    $methodsString .= "\n\n";
                }

                $methodsString .= $method->render();
                $index++;
            }
        }

        $string = self::replaceVarToken($string, 'METHODS', $methodsString);

        return $string;
    }
}