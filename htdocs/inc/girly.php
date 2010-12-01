<?php
$girly = file_get_contents(__DIR__ . '/../../data/girly');

if ($girly) {
    echo "<!--\n$girly\n-->\n";
}