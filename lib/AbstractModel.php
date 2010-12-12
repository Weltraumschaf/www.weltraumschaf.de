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

abstract class AbstractModel {
    public function  __construct($data = null) {
        if (null !== $data) {
            if (is_array($data)) {
                $this->fromArray($data);
            } else if ($data instanceof  stdClass) {
                $this->fromObject($data);
            } else {
                throw new InvalidArgumentException("Can not handle passed argeument of type " . gettype($data) . "!");
            }
        }
    }

    /**
     *
     * @param string $string
     * @return string
     */
    public function sanitize($s) {
        $s = trim($s);
        $s = str_replace(array("\n", "\r", "\t"), '', $s);

        while (false !== strpos($s, '  ')) {
            $s = str_replace('  ', ' ', $s);
        }

        return $s;
    }

    public function fromArray(array $data) {
        foreach ($data as $key => $value) {
            $setterName = 'set' . ucfirst($key);
            try {
                $this->$setterName($value);
            } catch (BadMethodCallException $e) {
                throw new InvalidArgumentException("Can not set property '$key'!");
            }
        }
    }

    public function fromObject(stdClass $data) {
        $properties = get_object_vars($data);
        $this->fromArray($properties);
    }

    public function  __call($name, $arguments) {
        throw new BadMethodCallException("Can not handle method call to '$name'!");
    }

    protected function generateJson(array $names = array()) {
        $json = '{';

        if (!empty($names)) {
            $index = 0
            ;
            foreach ($names as $name) {
                $getter = 'get' . ucfirst($name);

                if ($index > 0) {
                    $json .= ', ';
                }

                $json .= '"' . $name . '": "' . $this->$getter() . '"';
                $index++;
            }
        }

        $json .= '}';

        return $json;
    }
}