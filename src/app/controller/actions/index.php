<?php

namespace app\controller\actions\index;

use app\view;

/**
 * Handles index page
 */
function index_action(): array
{
    return view\render('index/index');
}
