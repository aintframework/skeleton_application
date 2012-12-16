<?php
namespace app\controller\actions\index;

require_once 'app/view.php';
use app\view;

function index_action() {
    return view\render('index/index');
}
