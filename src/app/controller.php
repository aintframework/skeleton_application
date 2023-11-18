<?php

namespace app\controller;

use aint\mvc\dispatching;

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
function run(): void {
    dispatching\dispatch_http_default_router(actions_namespace, error_handler);
}
