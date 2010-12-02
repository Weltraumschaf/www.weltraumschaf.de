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

require_once 'Jsonable.php';
require_once 'Cite.php';

/**
 * @todo fix cache invalidation: delete json file when xml hgas changed. make md5 over
 *       xml file content and save in cache file name. compare on loadeCache.
 */
class CiteCollection implements Countable, ArrayAccess, Jsonable {
    /**
     * @var array
     */
    private $cites;

    public function  __construct(array $cites = array()) {
        $this->cites = array();

        if (!empty($cites)) {
            foreach ($cites as $cite) {
                $this->add($cite);
            }
        }
    }

    /**
     * @param Cite $c
     */
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

    /**
     * @param int $offset
     * @return Cite
     */
    public function offsetGet($offset) {
        if ($this->offsetExists($offset)) {
            return $this->cites[$offset];
        }
        
        return null;
    }

    /**
     * @param int $offset
     * @param Cite $value
     */
    public function offsetSet($offset, $value) {
        if (! $value instanceof  Cite) {
            throw new InvalidArgumentException("This collection can only handle objects of type Cite!");
        }

        $this->cites[$offset] = $value;
    }

    /**
     * @param int $offset
     */
    public function offsetUnset($offset) {
        if ($this->offsetExists($offset)) {
            unset($this->cites[$offset]);
        }
    }

    /**
     * @return string
     */
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

    /**
     * @param string $json
     * @return CiteCollection
     */
    public static function loadFromJson($json) {
        $collection = new CiteCollection();
        $array = json_decode($json);

        if (false === $array) {
            throw new Exception("Cann ot decode json string!");
        }

        if (!empty($array)) {
            foreach ($array as $obect) {
                $collection->add(new Cite($obect));
            }
        }
        
        return $collection;
    }

    /**
     * @param string $fileName
     * @return CiteCollection
     */
    public static function loadFromXml(SimpleXMLElement $xml) {
        $collection = new CiteCollection();

        foreach ($xml->cite as $cite) {
            $collection->add(new Cite(array(
                'author' => $cite->author,
                'title'  => $cite->title,
                'text'   => $cite->text
            )));
        }
        
        return $collection;
    }
}