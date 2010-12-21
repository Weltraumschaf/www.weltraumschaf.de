<?php

require_once 'WS/Model/Xml/ConfigLoader.php';
require_once 'WS/Model/Xml/ConfigParser.php';
require_once 'WS/Model/Generator.php';

class WS_Model_Cli_Generator {
    const VERSION = '0.2';
    
    private $scriptName;
    private $argc;
    private $argv;
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
        $tplFactory = new WS_Model_Template_Factory(WS_MODEL_ROOT_DIRECTORY . '/tpl');
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