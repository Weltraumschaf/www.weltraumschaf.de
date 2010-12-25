<?php
require_once 'CiteBase.php';

class Cite extends CiteBase {
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
}