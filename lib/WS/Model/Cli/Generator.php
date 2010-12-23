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
 * @see WS_Model_Xml_ConfigLoader
 */
require_once 'WS/Model/Xml/ConfigLoader.php';
/**
 * @see  WS_Model_Xml_ConfigParser
 */
require_once 'WS/Model/Xml/ConfigParser.php';
/**
 * @see  WS_Model_Generator
 */
require_once 'WS/Model/Generator.php';

/**
 * This class holds the logic for the genarator script in bin/wsmodel
 *
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */
class WS_Model_Cli_Generator {
    /**
     * The version of ws-model
     */
    const VERSION = '0.2';
    /**
     * The name of the executing script. Usualy 'wsmodel'.
     *
     * @var string
     */
    private $scriptName;
    /**
     * Count of command line arguments.
     *
     * @var array
     */
    private $argc;
    /**
     * The passed command line argument.
     *
     * @var array
     */
    private $argv;
    /**
     * The current working directory.
     * 
     * @var string
     */
    private $cwd;

    public static function main($cwd, array $argv = array()) {
        try {
            $generator = new self($cwd, $argv);

            return $generator->run();
        } catch (Exception $e) {
            $generator->echoLine($e->getMessage());
            
            return $e->getCode();
        }
    }

    public function  __construct($cwd, array $argv = array()) {
        $scriptName = (string) array_shift($argv);
        $this->scriptName = str_replace('./', '', $scriptName);
        $this->cwd  = $cwd;
        $this->argc = count($argv);
        $this->argv = $argv;
        
    }

    public function getScriptName() {
        return $this->scriptName;
    }

    public function argumentCount() {
        return $this->argc;
    }

    public function arguments() {
        return $this->argv;
    }

    public function echoLine($line = '') {
        echo (string) $line . PHP_EOL;
    }
    
    public function argument($index, $fallback = null) {
        if (isset($this->argv[$index])) {
            return $this->argv[$index];
        } else {
            return $fallback;
        }
    }

    public function currentWorkingDirectory() {
        return $this->cwd;
    }

    public function run() {
        if (0 === $this->argumentCount()) { // too less args
            throw  new Exception('Please give at least a config file!' . PHP_EOL . $this->usage(), 1);
        }

        if (2 < $this->argumentCount()) { // too many args
            throw new Exception($this->usage(), 1);
        }

        if ('-h' === $this->argument(0) || '--help' === $this->argument(0)) {
            $this->echoLine($this->help());
            return 0;
        }

        if ('-v' === $this->argument(0) || '--version' === $this->argument(0)) {
            $this->echoLine($this->version());
            return 0;
        }

        $configFile = $this->argument(0);

        if (2 === $this->argumentCount()) {
            $targetDir = $this->argument(1);
        } else {
            $targetDir = $this->currentWorkingDirectory();
        }

        $this->echoLine("Reding config file from {$configFile},");
        $loader     = new WS_Model_Xml_ConfigLoader($configFile);
        $parser     = new WS_Model_Xml_ConfigParser($loader);
        $model      = $parser->parse();
        $tplFactory = new WS_Model_Template_Factory();
        $generator  = new WS_Model_Generator($model, $tplFactory);
        $classFiles = $generator->generateFiles();
        $this->echoLine("Write class files to {$targetDir}.");

        foreach ($classFiles as $file) {
            /* var $file WS_Model_File */
            $file->write($targetDir);
            echo '.';
        }

        $this->echoLine();
        $this->echoLine('Finished.');
        $this->echoLine();
        
        return 0;
    }

    public function usage() {
        return "Usage: {$this->getScriptName()} config [directory]" . PHP_EOL;
    }

    public function version() {
        return 'Version ' . self::VERSION . PHP_EOL;
    }

    public function help() {
        $help  = $this->usage() . PHP_EOL;
        $help .= '  config                  Path to the model configuration xml file.' . PHP_EOL;
        $help .= '  [directory]             Optiona target dir for generated files.' . PHP_EOL;
        $help .= '                          If omitted the current working directory is used.' . PHP_EOL;
        $help .= PHP_EOL;
        $help .= '  -h           --help     This help.' . PHP_EOL;
        $help .= '  -v           --version  Prints the current version.' . PHP_EOL;

        return $help;
    }
}