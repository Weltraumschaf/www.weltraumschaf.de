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
 * @copyright Copyright (c) 01.12.2010, Sven Strittmatter.
 * @version   0.2
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 */

require_once 'CiteCollection.php';

class CiteProvider {
    private $dataFile;
    private $cacheFile;
    private $collection;

    public function  __construct($file, $tmp = '/tmp') {
        $this->dataFile = (string) $file;

        if (!file_exists($this->dataFile)) {
            throw new InvalidArgumentException("File does not exits '{$this->dataFile}'!");
        }

        if (!is_readable($this->dataFile)) {
            throw new InvalidArgumentException("File is not readable '{$this->dataFile}'!");
        }

        $this->cacheFile = $tmp . '/' . basename($this->dataFile) . '.json';
    }

    protected function loadCollection() {
        $collection = $this->loadCachedFile();

        if (null === $collection) {
            $collection = $this->loadOriginFile();
            $this->saveToCacheFile($collection);
        }

        $this->collection = $collection;
    }

    protected function saveToCacheFile(CiteCollection $collection) {
        if (!file_put_contents($this->cacheFile, $collection->toJson())) {
            throw new RuntimeException("Can not write cache to file '{$this->cacheFile}'!");
        }
    }
    
    protected function loadOriginFile() {
        $xmlString = file_get_contents($this->dataFile);

        if (false === $xmlString) {
            throw new InvalidArgumentException("Can not read file content from '{$this->dataFile}'!");
        }

        $xml = new SimpleXMLElement($xmlString);

        return CiteCollection::loadFromXml($xml);
    }

    protected function loadCachedFile() {
        if (!file_exists($this->cacheFile)) {
            return null;
        }

        $jsonString = file_get_contents($this->cacheFile);

        if (false === $jsonString) {
            throw new InvalidArgumentException("Can not read file content from '{$this->cacheFile}'!");
        }

        return CiteCollection::loadFromJson($jsonString);
    }
    
    public function getCollection() {
        if (null === $this->collection) {
            $this->loadCollection();
        }

        return $this->collection;
    }
}