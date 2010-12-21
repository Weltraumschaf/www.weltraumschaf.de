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

class WS_Model_Xml_ConfigLoader {
    /**
     * @var string
     */
    private $file;
    /**
     * @var SimpleXMLElement
     */
    private $xml;

    public function  __construct($file) {
        $this->file = (string) $file;

        if (!is_readable($this->file)) {
            throw new InvalidArgumentException("Can not read config file '{$this->file}'!");
        }
    }

    /**
     * @return SimpleXMLElement
     */
    protected function loadConfig() {
        $xmlString = file_get_contents($this->file);

        if (false === $xmlString) {
            throw new RuntimeException("Can not read xml string from '{$this->file}'!");
        }

        return new SimpleXMLElement($xmlString);
    }

    /**
     * @return SimpleXMLElement
     */
    public function getXml() {
        if (null === $this->xml) {
            $this->xml = $this->loadConfig();
        }

        return $this->xml;
    }
}