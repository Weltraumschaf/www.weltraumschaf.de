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
    /**
     * @var SplFileInfo
     */
    private $dataFile;
    /**
     * @var SplFileInfo
     */
    private $cacheFile;
    /**
     * @var CiteCollection
     */
    private $collection;

    public function  __construct($file, $tmp = '/tmp') {
        $file = (string) $file;

        if (!file_exists($file)) {
            throw new InvalidArgumentException("File does not exits '{$file}'!");
        }

        if (!is_readable($file)) {
            throw new InvalidArgumentException("File is not readable '{$file}'!");
        }

        $this->dataFile  = new SplFileInfo($file);
        $this->cacheFile = new SplFileInfo($tmp . '/' . basename($file) . '.json');
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
        $xmlString = file_get_contents($this->dataFile->getPathname());

        if (false === $xmlString) {
            throw new InvalidArgumentException("Can not read file content from '{$this->dataFile->getPathname()}'!");
        }

        $xml = new SimpleXMLElement($xmlString);

        return CiteCollection::loadFromXml($xml);
    }

    protected function loadCachedFile() {
        if (!$this->cacheFile->isReadable()) {
            return null;
        }

        if ($this->cacheFile->getMTime() < $this->dataFile->getMTime()) {
            return null;
        }
        
        $jsonString = file_get_contents($this->cacheFile->getPathname());

        if (false === $jsonString) {
            throw new InvalidArgumentException("Can not read file content from '{$this->cacheFile->getPathname()}'!");
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