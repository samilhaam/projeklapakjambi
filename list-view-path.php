<?php

$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('/layouts/front'));

foreach ($rii as $file) {
    if (!$file->isDir()) {
        echo $file->getPathname() . PHP_EOL;
    }
}
