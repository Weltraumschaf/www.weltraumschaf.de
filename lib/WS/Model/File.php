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
 * Represents a generated code file (usually a class file).
 * 
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */
class WS_Model_File {
    /**
     * Default file extension.
     */
    const DEFAULT_EXTENSION = '.php';
    /**
     * This character will be changed in the name to the directory separator.
     */
    const DIR_DELIMITER     = '_';
    /**
     * The files name.
     *
     * @var string
     */
    private $name;
    /**
     * The files content
     *
     * @var string
     */
    private $content;
    /**
     * The files extension.
     *
     * @var string
     */
    private $extension;
    /**
     * The names directory delimiter (@see WS_Model_File::DIR_DELIMITER).
     *
     * @var string
     */
    private $delimiter;
    /**
     * The base name is the file name replaced the DIR_DELIMITER with the
     * directory separator and appended file extension.
     * 
     * @var string
     */
    private $baseName;

    /**
     *
     * @param string $name
     * @param string $content
     * @param string $ext
     * @param string $del
     */
    public function  __construct($name, $content, $ext = self::DEFAULT_EXTENSION, $del = self::DIR_DELIMITER) {
        $this->name      = (string) $name;
        $this->content   = (string) $content;
        $this->extension = (string) $ext;
        $this->delimiter = (string) $del;

        if ('.' !== $this->extension[0]) {
            $this->extension = '.' . $this->extension;
        }
    }

    /**
     * Returns the files name.
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Returns the file extension.
     * 
     * @return string
     */
    public function getExtension() {
        return $this->extension;
    }

    /**
     * Returns the file content.
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Returns the files base name.
     *
     * It consists of the filename with replaced DIR_DELIMITER and appended
     * extension.
     *
     * @todo Implement DIR_DELIMITER
     *
     * @return string
     */
    public function getBaseName() {
        if (null === $this->baseName) {
//            $baseName = str_replace(self::DIR_DELIMITER, DIRECTORY_SEPARATOR, $this->getName());
            $this->baseName = $this->getName() . $this->getExtension();
        }
        
        return $this->baseName;
    }

    /**
     * Writes the content to a file named by getBaseName().
     *
     * @param string $directory The directory where the file will be stored.
     *
     * @throws InvalidArgumentException Write/write errors.
     * @throws Exception On failing write.
     * 
     * @return void
     */
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