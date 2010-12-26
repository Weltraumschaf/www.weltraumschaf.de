<?php
require_once 'CiteBase.php';

class Cite extends CiteBase {
    
    protected function init($data = null) {
        if (null === $data) {
            $data = array();
        }

        $propertyNames = $this->getPropertyNames();

        if (!empty($propertyNames)) {
            foreach ($propertyNames as $name) {
                if (is_array($data)) {
                    if (isset($data[$name])) {
                        $data[$name] = $this->sanitize($data[$name]);
                    } else {
                        $data[$name] = '';
                    }
                } else if ($data instanceof stdClass) {
                    if (property_exists($data, $name)) {
                        $data->{$name} = $this->sanitize($data->{$name});
                    } else {
                        $data->{$name} = '';
                    }
                }
            }
        }

        return $data;
    }

    public function hasTitle() {
        return '' !== $this->getTitle();
    }

    /**
     *
     * @param string $string
     * @return string
     */
    public function sanitize($s) {
        $s = trim((string) $s);
        $s = str_replace(array("\n", "\r", "\t"), ' ', $s);

        while (false !== strpos($s, '  ')) {
            $s = str_replace('  ', ' ', $s);
        }

        return $s;
    }
}