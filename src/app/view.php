<?php
namespace app\view;

require_once 'aint/templating.php';
use aint\templating; 
require_once 'aint/http.php';
use aint\http;

/**
 * Custom templates parameters
 * path and file extension
 */
const templates_path = 'app/view/templates/',
      template_ext = '.phtml';

/**
 * Layout template, for 2-step rendering strategy
 */
const layout_template = 'layout';

/**
 * Variable to hold inner template rendering result
 * within the layout
 */
const layout_content_var = 'content';

/**
 * Rendering for controller actions
 * 2-step strategy
 * returns http response data
 *
 * @param $template
 * @param array $vars
 * @return array
 */
function render($template, $vars = []) {
    return http\build_response(
        render_template(layout_template,[
            layout_content_var => render_template($template, $vars)
        ])
    );
}

/**
 * Renders one template from `templates` directory
 *
 * @param $template
 * @param array $vars
 * @return string
 */
function render_template($template, $vars = []) {
    return templating\render_template(
        templates_path . $template . template_ext, $vars);
}