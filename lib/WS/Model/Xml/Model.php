<?php

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