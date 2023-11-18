<?php

namespace app\controller\actions\site;

use app\view;

/**
 * Handles index page
 */
function index_action(): array
{
    return view\render('site/index');
}
