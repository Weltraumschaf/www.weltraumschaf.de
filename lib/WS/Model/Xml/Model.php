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

class WS_Model_Xml_Model {
    private $entities;

    public function  __construct() {
        $this->entities = array();
    }

    /**
     *
     * @param WS_Model_Xml_Entity $e
     * @throws InvalidArgumentException On properties with dublicate names.
     */
    public function addEntity(WS_Model_Xml_Entity $e) {
        if ($this->hasEntity($e->getName())) {
            throw new InvalidArgumentException("Entity with name '{$e->getName()}' allready added to the model!");
        }

        $this->entities[$e->getName()] = $e;
    }

    /**
     *
     * @return int
     */
    public function countEntities() {
        return count($this->entities);
    }

    public function hasEntites() {
        return 0 < $this->countEntities();
    }

    /**
     *
     * @return array
     */
    public function getEntities() {
        return $this->entities;
    }

    /**
     *
     * @param string $name
     * @return bool
     */
    public function hasEntity($name) {
        return array_key_exists((string) $name, $this->entities);
    }

    /**
     *
     * @param string $name
     * @return WS_Model_Xml_Entity
     */
    public function getEntity($name) {
        if ($this->hasEntity($name)) {
            return $this->entities[(string) $name];
        }

        return null;
    }
}