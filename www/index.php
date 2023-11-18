<?php

error_reporting(E_ALL);

set_include_path(get_include_path()
    . PATH_SEPARATOR . realpath(dirname(__FILE__) . '/../src')
    #. PATH_SEPARATOR . realpath(dirname(__FILE__) . '/../vendor/aintframework/aint_framework/library')
);

require dirname(__DIR__, 1) . '/src/app/autoload.php';

app\controller\run();
