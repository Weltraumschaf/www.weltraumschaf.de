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
 * @see WS_Model_Template_Abstract
 */
require_once 'WS/Model/Template/Abstract.php';
/**
 * @see WS_Model_Template_DocComment_Argument
 */
require_once 'WS/Model/Template/DocComment/Annotation.php';

/**
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */
class WS_Model_Template_DocComment extends WS_Model_Template_Abstract {
    protected $annotations;

    public function  __construct($tplFile) {
        parent::__construct($tplFile);
        $this->annotations = array();
    }

    /**
     *
     * @param string $text
     */
    public function setLongDesc($text) {
        $this->assignVar('LONG_DESC', (string) $text);
    }

    /**
     *
     * @return string
     */
    public function getLongDesc() {
        return $this->getAssignedVar('LONG_DESC');
    }

    /**
     *
     * @param string $text
     */
    public function setShortDesc($text) {
        $this->assignVar('SHORT_DESC', (string) $text);
    }

    /**
     *
     * @return string
     */
    public function getShortDesc() {
        return $this->getAssignedVar('SHORT_DESC');
    }

    /**
     *
     * @param WS_Model_Template_DocComment_Anotation $a
     */
    public function addAnnotation(WS_Model_Template_DocComment_Annotation $a) {
        $this->annotations[] = $a;
    }

    /**
     *
     * @return int
     */
    public function countAnnotations() {
        return count($this->annotations);
    }

    /**
     *
     * @return string
     */
    public function render() {
        $string = $this->readTemplate();
        $text   = '';
        
        if ($this->hasAssignedVar('SHORT_DESC')) {
            $text .= ' ' . $this->getShortDesc();
        }

        if ($this->hasAssignedVar('LONG_DESC')) {
            if ($this->hasAssignedVar('SHORT_DESC')) {
                $text .= PHP_EOL;
                $text .= ' *' . PHP_EOL;
                $text .= ' *';
            }
            
            $text .= ' ' . $this->getLongDesc();
        }

        $annotationsString = '';

        if ($this->countAnnotations()) {
            if (!empty($text)) {
                $text .= PHP_EOL . ' *';
            }
            foreach ($this->annotations as $index => $annotation) {
                /* @var WS_Model_Template_DocComment_Annotation $annotation */
                if ($index > 0) {
                    $annotationsString .= PHP_EOL . ' *';
                }
                
                $annotationsString .= ' ' . $annotation->render();
            }
        }

        $string = self::replaceVarToken($string, 'TEXT', $text);
        $string = self::replaceVarToken($string, 'ANNOTATIONS', $annotationsString);

        return $string;
    }
}