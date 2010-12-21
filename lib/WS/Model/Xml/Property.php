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

class WS_Model_Xml_Property {
    const TYPE_ARRAY  = 'array';
    const TYPE_DOUBLE = 'double';
    const TYPE_FLOAT  = 'float';
    const TYPE_INT    = 'int';
    const TYPE_STRING = 'string';
    
    private $name;
    private $type;
    private $isNative;

    public function  __construct($name, $type) {
        $this->name = (string) $name;
        $this->type = (string) $type;

        if (in_array($this->type, array(self::TYPE_ARRAY, self::TYPE_DOUBLE, self::TYPE_FLOAT, self::TYPE_INT, self::TYPE_STRING))) {
            $this->isNative = true;
        } else {
            $this->isNative = false;
        }
    }

    public function getName() {
        return $this->name;
    }

    public function getType() {
        return $this->type;
    }

    public function isNativeType() {
        return $this->isNative;
    }

    public function isObjectType() {
        return !$this->isNativeType();
    }

    public function isArrayType() {
        return self::TYPE_ARRAY === $this->type;
    }
}