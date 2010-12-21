<?php

require_once 'WS/Model/Template/Abstract.php';
require_once 'WS/Model/Template/Property.php';
require_once 'WS/Model/Template/Method.php';

class WS_Model_Template_Class extends WS_Model_Template_Abstract {
    private $properties;
    private $methods;

    public function  __construct($tplFile) {
        parent::__construct($tplFile);
        $this->properties = array();
        $this->methods    = array();
    }

    public function setName($name) {
        $this->assignVar('NAME', (string) $name);
    }

    public function getName() {
        return $this->getAssignedVar('NAME');
    }

    public function setBaseClass($className) {
        $this->assignVar('BASE_CLASS_NAME', (string) $className);
    }

    public function getBaseClass() {
        return $this->getAssignedVar('BASE_CLASS_NAME');
    }

    public function hasBaseClass() {
        if (!$this->hasAssignedVar('BASE_CLASS_NAME')) {
            return false;
        }

        return '' !== $this->getAssignedVar('BASE_CLASS_NAME');
    }

    public function addProperty(WS_Model_Template_Property $p) {
        $this->properties[$p->getName()] = $p;
    }

    public function countProperties() {
        return count($this->properties);
    }

    public function getProperties() {
        return $this->properties;
    }

    public function hasProperty($name) {
        return array_key_exists((string) $name, $this->properties);
    }

    public function getProperty($name) {
        if ($this->hasProperty($name)) {
            return $this->properties[(string) $name];
        }

        return null;
    }

    public function addMethod(WS_Model_Template_Method $m) {
        $this->methods[$m->getName()] = $m;
    }

    public function hasMethod($name) {
        return array_key_exists((string) $name, $this->methods);
    }

    public function getMethod($name) {
        if ($this->hasMethod($name)) {
            return $this->methods[(string) $name];
        }

        return null;
    }

    public function countMethods() {
        return count($this->methods);
    }

    public function getMethods() {
        return $this->methods;
    }

    public static function generateFileName($className, $extension = '.php') {
        if ('.' !== $extension[0]) {
            $extension = '.' . $extension;
        }

        return str_replace('_', '/', $className) . $extension;
    }

    public function render() {
        if (!$this->hasAssignedVar('NAME')) {
            throw new Exception("Does not have required variable 'NAME' assigned!");
        }

        $string = $this->readTemplate();
        $string = self::replaceVarToken($string, 'NAME', $this->getAssignedVar('NAME'));
        $baseClassRequireString = '';
        $baseClassExtendsString = '';

        if ($this->hasBaseClass()) {
            $baseClassName = $this->getBaseClass();
            $baseFileName  = self::generateFileName($baseClassName);
            $baseClassRequireString = "require_once '{$baseFileName}';\n";
            $baseClassExtendsString = " extends {$baseClassName}";
        }

        $string = self::replaceVarToken($string, 'BASE_CLASS_REQUIRE', $baseClassRequireString);
        $string = self::replaceVarToken($string, 'BASE_CLASS_NAME', $baseClassExtendsString);
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