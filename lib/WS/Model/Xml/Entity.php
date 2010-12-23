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
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */
class WS_Model_Xml_Entity {
    /**
     *
     * @var string
     */
    private $name;
    /**
     *
     * @var array
     */
    private $properties;

    public function  __construct($name) {
        $this->name       = (string) $name;
        $this->properties = array();
    }

    /**
     *
     * @param WS_Model_Xml_Property $p
     * @throws WS_Model_Xml_Property On dublicate property names.
     */
    public function addProperty(WS_Model_Xml_Property $p) {
        if ($this->hasProperty($p->getName())) {
            throw new InvalidArgumentException("Property with name '{$p->getName()}' allready added to the entity!");
        }
        
        $this->properties[$p->getName()] = $p;
    }

    /**
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     *
     * @param string $name
     * @return bool
     */
    public function hasProperty($name) {
        return array_key_exists($name, $this->properties);
    }

    /**
     *
     * @param string $name
     * @return WS_Model_Xml_Property
     */
    public function getProperty($name) {
        if ($this->hasProperty($name)) {
            return $this->properties[(string) $name];
        }

        return null;
    }

    public function countProperties() {
        return count($this->properties);
    }

    public function getProperties() {
        return $this->properties;
    }
}