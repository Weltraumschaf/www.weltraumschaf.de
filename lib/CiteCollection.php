<?php
require_once 'Jsonable.php';

class CiteCollection implements Countable, ArrayAccess, Jsonable {
    private $cites;

    public function  __construct(array $cites = array()) {
        $this->cites = array();

        if (!empty($cites)) {
            foreach ($cites as $cite) {
                $this->add($cite);
            }
        }
    }

    public function add(Cite $c) {
        $this->cites[] = $c;
    }

    /**
     * @return int
     */
    public function  count() {
        return count($this->cites);
    }

    /**
     * @param int $offset
     * @return bool
     */
    public function offsetExists($offset) {
        return array_key_exists((int)$offset, $this->cites);
    }

    public function offsetGet($offset) {
        if ($this->offsetExists($offset)) {
            return $this->cites[$offset];
        }
        
        return null;
    }

    public function offsetSet($offset, $value) {
        if (! $value instanceof  Cite) {
            throw new InvalidArgumentException("This collection can only handle objects of type Cite!");
        }

        $this->cites[$offset] = $value;
    }

    public function offsetUnset($offset) {
        if ($this->offsetExists($offset)) {
            unset($this->cites[$offset]);
        }
    }

    public function  toJson() {
        $jsonString = '[';

        if ($this->count() > 0) {
            foreach ($this->cites as $index => $cite) {
                /* @var $cite Cite */
                if ($index > 0) {
                    $jsonString .= ', ';
                }

                $jsonString .= $cite->toJson();
            }
        }

        $jsonString .= ']';

        return $jsonString;
    }

    public static function loadFromXml($fileName) {

    }

    public static function loadFromJsonFile($fileName) {
        
    }
}