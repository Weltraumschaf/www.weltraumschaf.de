<?php
require_once 'WS/Model/IToArray.php';
require_once 'WS/Model/IToJson.php';
require_once 'WS/Model/IToStdClass.php';

abstract class WS_Model_AbstractBase implements WS_Model_IToArray, WS_Model_IToJson, WS_Model_IToStdClass {
    private $propertyNames;

    public static function generateSetterName($propertyName) {
        return 'set' . ucfirst($propertyName);
    }

    public static function generateGetterName($propertyName) {
        return 'get' . ucfirst($propertyName);
    }

    public function  __construct(array $propertyNames) {
        $this->propertyNames = $propertyNames;
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
    
    protected function convertToArray(array $propertyNames) {
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

    protected function convertToJson(array $asAssocArray) {
        return json_encode($asAssocArray);
    }

    protected function convertToStdClass(array $asAssocArray) {
        $std = new stdClass();

        if (!empty($asAssocArray)) {
            foreach ($asAssocArray as $name => $value) {
                $std->{$name} = $value;
            }
        }

        return $std;
    }

    /**
     * Will be implemented by the generated class.
     *
     * Example:
     * <code>
     * public function toArray() {
     *   return $this->convertToArray(array('nameOne', 'nameTwo', 'nameThre'));
     * }
     * </code>
     *
     * @return array
     */
//    public function toArray();

    /**
     * Will be implemented by the generated class.
     *
     * Example:
     * <code>
     * public function toJson() {
     *   return $this->convertToJson(array('nameOne', 'nameTwo', 'nameThre'));
     * }
     * </code>
     *
     * @return string
     */
//    public function toJson();

    /**
     * Will be implemented by the generated class.
     *
     * Example:
     * <code>
     * public function toJson() {
     *   return $this->convertToStdClass(array('nameOne', 'nameTwo', 'nameThre'));
     * }
     * </code>
     *
     * @return stdClass
     */
//    public function toStdClass();
}