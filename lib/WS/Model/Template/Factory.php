<?php

require_once 'WS/Model/Template/Argument.php';
require_once 'WS/Model/Template/Class.php';
require_once 'WS/Model/Template/DocComment.php';
require_once 'WS/Model/Template/DocComment/Argument.php';
require_once 'WS/Model/Template/Method.php';
require_once 'WS/Model/Template/Property.php';

class WS_Model_Template_Factory {
    const DEFAULT_TPL_EXT = '.tpl';

    /**
     * @var string
     */
    private $templateDir;
    /**
     *
     * @var string
     */
    private $templateExtension;

    public function  __construct($templateDir, $templateExtension = self::DEFAULT_TPL_EXT) {
        $this->templateDir = $templateDir;

        if ($templateExtension[0] !== '.') {
            $this->templateExtension = '.' . $templateExtension;
        } else {
            $this->templateExtension = $templateExtension;
        }
    }

    /**
     *
     * @param string $tplName
     * @return string
     */
    public function generateFileName($tplName) {
        return $this->templateDir . '/' . $tplName . $this->templateExtension;
    }

    /**
     *
     * @return WS_Model_Template_Argument
     */
    public function createArgumentTemplate() {
        return new WS_Model_Template_Argument($this->generateFileName('argument'));
    }

    /**
     *
     * @return WS_Model_Template_Class
     */
    public function createClassTemplate() {
        return new WS_Model_Template_Class($this->generateFileName('class'));
    }

    /**
     *
     * @return WS_Model_Template_DocComment
     */
    public function createDocCommentTemplate() {
        return new WS_Model_Template_DocComment($this->generateFileName('doccomment'));
    }

    /**
     *
     * @return WS_Model_Template_DocComment_Argument
     */
    public function createDocCommentArgumentTemplate() {
        return new WS_Model_Template_DocComment_Argument($this->generateFileName('doccomment/argument'));
    }

    /**
     *
     * @return WS_Model_Template_Method
     */
    public function createMethodTemplate() {
        return new WS_Model_Template_Method($this->generateFileName('method'));
    }

    /**
     *
     * @return WS_Model_Template_Property 
     */
    public function createPropertyTemplate() {
        return new WS_Model_Template_Property($this->generateFileName('property'));
    }    
}