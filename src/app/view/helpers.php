<?php
namespace app\view\helpers;

require_once 'app/view.php';
use app\view;
require_once 'aint/mvc/routing.php';
use aint\mvc\routing;
require_once 'app/model.php';
use app\model;

const head_title_separator = ' >> ';

function head_title($text = null) { // todo: consider moving to the framework
    static $title = '';
    if ($text !== null)
        if ($title === '')
            $title = htmlspecialchars($text);
        else
            $title = htmlspecialchars($text . head_title_separator) . $title;
    return '<title>' . $title . '</title>';
}

function uri($route_action, $route_params = []) {
    return routing\assemble_segment($route_action, $route_params);
}

function translate($text) {
    return model\translate($text);
}