<?php
namespace app\controller;

require_once 'aint/mvc/dispatching.php';
use aint\mvc\dispatching;

// actions
require_once 'app/controller/actions/index.php';
require_once 'app/controller/actions/errors.php';

/**
 * Namespace for application action-functions
 */
const actions_namespace = 'app\controller\actions';

/**
 * Function to handle errors happening during dispatching process
 */
const error_handler = 'app\controller\actions\errors\error_action';

/**
 * Runs the app, calls default dispatching strategy provided
 * by aint framework.
 */
function run() {
    dispatching\dispatch_http_default_router(actions_namespace, error_handler);
}
