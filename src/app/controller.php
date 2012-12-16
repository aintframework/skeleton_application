<?php
namespace app\controller;

require_once 'aint/mvc/dispatching.php';
use aint\mvc\dispatching;

// actions
require_once 'app/controller/actions/index.php';
require_once 'app/controller/actions/errors.php';

const actions_namespace = 'app\controller\actions';
const error_handler = 'app\controller\actions\errors\error_action';

function run() {
    dispatching\run_default(actions_namespace, error_handler);
}