<?php
namespace app\controller\actions\index;

require_once 'app/view.php';
use app\view;

/**
 * Handles index page
 *
 * @return array
 */
function index_action() {
    return view\render('index/index');
}
