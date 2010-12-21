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

require_once 'WS/Model/Xml/ConfigLoader.php';
require_once 'WS/Model/Xml/Model.php';
require_once 'WS/Model/Xml/Entity.php';
require_once 'WS/Model/Xml/Property.php';

class WS_Model_Xml_ConfigParser {
    /**
     * @var WS_Model_Xml_ConfigLoader
     */
    private $config;

    public function  __construct(WS_Model_Xml_ConfigLoader $config) {
        $this->config = $config;
    }

    protected function expectTag($name, SimpleXMLElement $xml) {
        if ($name !== $xml->getName()) {
            throw new Exception("Expected tag <$name>! Giveb tag was <{$xml->getName()}>.");
        }
    }

    protected function parseEntity(SimpleXMLElement $xml) {
        $this->expectTag('entity', $xml);
        $attributes = $xml->attributes();

        if (!isset($attributes['name'])) {
            throw new Exception("Does not have expected attribute name in entity tag!");
        }

        $entity = new WS_Model_Xml_Entity($attributes['name']);

        foreach ($xml as $node) {
            $entity->addProperty($this->parseProperty($node));
        }

        return $entity;
    }

    protected function parseProperty(SimpleXMLElement $xml) {
        $this->expectTag('property', $xml);

        $attributes = $xml->attributes();

        if (!isset($attributes['name'])) {
            throw new Exception("Does not have expected attribute 'name' in entity tag!");
        }

        $attributes = $xml->attributes();

        if (!isset($attributes['type'])) {
            throw new Exception("Does not have expected attribute 'type' in entity tag!");
        }

        return new WS_Model_Xml_Property($attributes['name'], $attributes['type']);
    }

    /**
     * @return WS_Model_Xml_Model
     */
    public function parse() {
        $xml = $this->config->getXml();
        $this->expectTag('model', $xml);
        $model = new WS_Model_Xml_Model();

        foreach ($xml as $node) {
            $model->addEntity($this->parseEntity($node));
        }

        return $model;
    }
}