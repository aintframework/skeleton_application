<?php
namespace app\view;

require_once 'aint/templating.php';
use aint\templating; 
require_once 'aint/http.php';
use aint\http;

const templates_path = 'app/view/templates/';
const template_ext = '.phtml';
const layout_template = 'layout';
const layout_content_var = 'content';

/**
 * Rendering for controller actions
 * 2-step strategy
 * returns http response data
 */
function render($template, $vars = []) {
    return http\build_response(
        render_template(layout_template,[
            layout_content_var => render_template($template, $vars)
        ])
    );
}

function render_template($template, $vars = []) {
    return templating\render_template(
        templates_path . $template . template_ext, $vars);
}