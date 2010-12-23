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
 * @category  WS
 * @package   Model
 * @author    Sven Strittmatter <ich@weltraumschaf.de>
 * @copyright 2010 Sven Strittmatter
 * @license   http://www.weltraumschaf.de/the-beer-ware-license.txt
 * @version   0.3
 * @link      https://github.com/Weltraumschaf/ws-view
 */
abstract class WS_Model_Template_Abstract {
    const NAME_DELIMITER = '#';
    const INDENTATION    = '    ';

    const MODIFIER_PRIVATE   = 'private';
    const MODIFIER_PROTECTED = 'protected';
    const MODIFIER_PUBLIC    = 'public';

    /**
     * Used to check assigned modifiers against.
     * 
     * @var array
     */
    private static $allowedModifiers = array(
        self::MODIFIER_PRIVATE,
        self::MODIFIER_PROTECTED,
        self::MODIFIER_PUBLIC
    );
    
    /**
     * The file name of the template.
     *
     * @var string
     */
    private $tplFile;
    /**
     * Key value assigned templaet variables.
     * 
     * @var array
     */
    private $assignedVars;

    public function  __construct($tplFile) {
        $tplFile = (string) $tplFile;
        
        if (!is_readable($tplFile)) {
            throw new InvalidArgumentException("Can not read template file: $tplFile!");
        }

        $this->tplFile = $tplFile;
        $this->assignedVars = array();
    }

    protected function assignVar($name, $value) {
        $this->assignedVars[$name] = (string) $value;
    }

    protected function hasAssignedVar($name) {
        return array_key_exists($name, $this->assignedVars) && !empty($this->assignedVars[$name]);
    }

    protected function getAssignedVar($name) {
        if ($this->hasAssignedVar($name)) {
            return $this->assignedVars[$name];
        }

        return null;
    }

    /**
     * @return string
     */
    public abstract function render();

    protected function readTemplate() {
        return file_get_contents($this->tplFile);
    }

    public function getValidModifiers() {
        return self::$allowedModifiers;
    }

    public function isValidModifier($modifier) {
        return in_array((string) $modifier, $this->getValidModifiers());
    }

    public function expectValidModifier($modifier) {
        if (!$this->isValidModifier($modifier)) {
            throw new InvalidArgumentException("Invalid modifier given: $modifier! Allowed are: " .
                                               implode(', ', $this->getValidModifiers()));
        }
    }

    public static function replaceVarToken($subject, $varname, $replacement = '') {
        return str_replace(self::NAME_DELIMITER . $varname . self::NAME_DELIMITER,
                           $replacement, $subject);
    }

    public static function getIndentation($time = 1) {
        $time = (int) $time;
        
        return str_repeat(self::INDENTATION, max(1, $time));
    }
}