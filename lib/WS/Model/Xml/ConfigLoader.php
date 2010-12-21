<?php

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