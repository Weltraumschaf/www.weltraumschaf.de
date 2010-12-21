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

/**
 * @see WS_Model_Template_Argument
 */
require_once 'WS/Model/Template/Argument.php';
/**
 * @see WS_Model_Template_Class
 */
require_once 'WS/Model/Template/Class.php';
/**
 * @see WS_Model_Template_DocComment
 */
require_once 'WS/Model/Template/DocComment.php';
/**
 * @see WS_Model_Template_DocComment_Argument
 */
require_once 'WS/Model/Template/DocComment/Argument.php';
/**
 * @see WS_Model_Template_Method
 */
require_once 'WS/Model/Template/Method.php';
/**
 * @see WS_Model_Template_Property
 */
require_once 'WS/Model/Template/Property.php';

class WS_Model_Template_Factory {
    /**
     * Default file extension for template files.
     */
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