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

class WS_Model_File {
    const DEFAULT_EXTENSION = '.php';
    const DIR_DELIMITER     = '_';

    private $name;
    private $content;
    private $extension;
    private $delimiter;
    private $baseName;
    
    public function  __construct($name, $content, $ext = self::DEFAULT_EXTENSION, $del = self::DIR_DELIMITER) {
        $this->name      = (string) $name;
        $this->content   = (string) $content;
        $this->extension = (string) $ext;
        $this->delimiter = (string) $del;

        if ('.' !== $this->extension[0]) {
            $this->extension = '.' . $this->extension;
        }
    }

    public function getName() {
        return $this->name;
    }

    public function getExtension() {
        return $this->extension;
    }

    public function getContent() {
        return $this->content;
    }

    public function getBaseName() {
        if (null === $this->baseName) {
//            $baseName = str_replace(self::DIR_DELIMITER, DIRECTORY_SEPARATOR, $this->getName());
            $this->baseName = $this->getName() . $this->getExtension();
        }
        
        return $this->baseName;
    }

    public function write($directory) {
        $directory = (string) $directory;
        $fileName  = $directory . DIRECTORY_SEPARATOR . $this->getBaseName();

        if (!file_exists($fileName) && !is_writable($directory)) {
            throw new InvalidArgumentException("Directory '{$directory}' must be writable!");
        }

        if (file_exists($fileName) && !is_writable($fileName)) {
            throw new InvalidArgumentException("File '{$fileName}' must be writable!");
        }

        if (!file_put_contents($fileName, $this->getContent())) {
            throw new Exception("Can not write content to file '{$fileName}'!");
        }
    }
}