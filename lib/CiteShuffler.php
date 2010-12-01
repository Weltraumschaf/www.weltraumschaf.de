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

class CiteShuffler {
    /**
     * @var CiteCollection
     */
    private $collection;

    /**
     * @param CiteCollection $collection
     */
    public function __construct(CiteCollection $collection) {
        $this->collection = $collection;
    }

    /**
     * @return Cite
     */
    public function getCite() {
        $index = mt_rand(0, $this->collection->count() - 1);

        return $this->collection[$index];
    }
}