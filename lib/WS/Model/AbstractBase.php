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
 * @see WS_Model_IToArray
 */
require_once 'WS/Model/IToArray.php';
/**
 * @see WS_Model_IFromArray
 */
require_once 'WS/Model/IFromArray.php';
/**
 * @see WS_Model_IToJson
 */
require_once 'WS/Model/IToJson.php';
/**
 * @see WS_Model_IFromJson
 */
require_once 'WS/Model/IFromJson.php';
/**
 * @see WS_Model_IToStdClass
 */
require_once 'WS/Model/IToStdClass.php';
/**
 * @see WS_Model_IFromStdClass
 */
require_once 'WS/Model/IFromStdClass.php';

/**
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */
abstract class WS_Model_AbstractBase implements WS_Model_IToArray, WS_Model_IToJson, WS_Model_IToStdClass,
                                                WS_Model_IFromArray, WS_Model_IFromJson, WS_Model_IFromStdClass {
    private $propertyNames;

    public static function generateSetterName($propertyName) {
        return 'set' . ucfirst($propertyName);
    }

    public static function generateGetterName($propertyName) {
        return 'get' . ucfirst($propertyName);
    }

    public function  __construct(array $propertyNames, $data = null) {
        $this->propertyNames = $propertyNames;

        if (null !== $data) {
            if (is_array($data)) {
                $this->fromArray($data);
            } else if ($data instanceof  stdClass) {
                $this->fromStdClass($data);
            } else {
                if (is_object($data)) {
                    $type = get_class($data);
                } else {
                    $type = gettype($data);
                }

                throw new InvalidArgumentException("Can not handle passed argeument of type {$type}!");
            }
        }
    }

    public function  __call($name, $arguments) {
        throw new BadMethodCallException("Does not recognize method with name '{$name}'!");
    }

    public static function  __callStatic($name, $arguments) {
        throw new BadMethodCallException("Does not recognize static method with name '{$name}'!");
    }

    public function  __set($name, $value) {
        throw new UnexpectedValueException("Does not recognize property with name '{$name}' to set!");
    }

    public function  __get($name) {
        throw new UnexpectedValueException("Does not recognize property with name '{$name}' to get!");
    }

    protected function getPropertyNames() {
        return $this->propertyNames;
    }

    /**
     *
     * @return array
     */
    public function toArray() {
        $propertyNames = $this->getPropertyNames();

        $arr = array();

        if (!empty($propertyNames)) {
            foreach ($propertyNames as $propertyName) {
                $getterName = self::generateGetterName($propertyName);

                if (!method_exists($this, $getterName)) {
                    throw new InvalidArgumentException("Object does not have a property named '$propertyName'!");
                }

                $arr[$propertyName] = $this->{$getterName}();
            }
        }

        return $arr;
    }

    public function fromArray(array $properties) {
        if (empty($properties)) {
            return;
        }

        foreach ($properties as $name => $value) {
            $setterName = self::generateSetterName($name);

            try {
                $this->{$setterName}($value);
            } catch (BadMethodCallException $e) {
                throw new InvalidArgumentException("Can not set property '$name'!");
            }
        }
    }

    /**
     * @return string
     */
    public function toJson() {
        return json_encode($this->toArray());
    }

    public function fromJson($string) {
        $string = (string) $string;

        if (empty($string)) {
            return;
        }

        $object = json_decode($string);
        $this->fromStdClass($object);
    }

    /**
     * @return stdClass
     */
    public function toStdClass() {
        $std = new stdClass();
        $asAssocArray = $this->toArray();

        if (!empty($asAssocArray)) {
            foreach ($asAssocArray as $name => $value) {
                $std->{$name} = $value;
            }
        }

        return $std;
    }

    public function fromStdClass(stdClass $object) {
        $properties = get_object_vars($object);
        $this->fromArray($properties);
    }
}