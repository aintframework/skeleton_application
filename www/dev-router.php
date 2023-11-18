<?php

/**
 * For built-in php server routing
 */
if ($_SERVER['REQUEST_URI'] == '/'
    || is_file($_SERVER['DOCUMENT_ROOT']
        . $_SERVER['REQUEST_URI'])
)
    return false;
else
    require 'index.php';
