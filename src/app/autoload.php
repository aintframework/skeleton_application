<?php

function require_files(string $directory): void {
    $directoryIterator = new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS);
    $iteratorIterator = new RecursiveIteratorIterator($directoryIterator);
    foreach ($iteratorIterator as $file) {
        if ($file->isDir()) continue;
        if ($file->getExtension() !== 'php') continue;
        if ($file->getPathname() === __FILE__) continue;
        require $file->getPathname();
    }
}

require_files(dirname(__DIR__, 2) . '/vendor/aint/framework/library');
require_files(__DIR__);
