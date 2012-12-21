<?php
namespace app\view\helpers;

require_once 'app/view.php';
use app\view;
require_once 'aint/mvc/routing.php';
use aint\mvc\routing;
require_once 'app/model.php';
use app\model;

/**
 * Separator for the <title/> tag content parts
 */
const head_title_separator = ' >> ';

/**
 * Stores static title value and appends any prepents $test
 * using head_title_separator as delimiter.
 *
 * Returns html tag prepared <title>...</title>
 *
 * @param string|null $text
 * @return string
 */
function head_title($text = null) {
    static $title = '';
    if ($text !== null)
        if ($title === '')
            $title = htmlspecialchars($text);
        else
            $title = htmlspecialchars($text . head_title_separator) . $title;
    return '<title>' . $title . '</title>';
}

/**
 * Converts action function name and the parameters list back to URI
 *
 * @param $route_action
 * @param array $route_params
 * @return string
 */
function uri($route_action, $route_params = []) {
    return routing\assemble_segment($route_action, $route_params);
}

/**
 * Translates given piece of text, using model's translator
 *
 * @param $text
 * @return string
 */
function translate($text) {
    return model\translate($text);
}