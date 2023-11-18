<?php
namespace tests\aint\mvc\dispatching_dispatch_http_default_router_test;

\aint\test\require_mock('aint/mvc/dispatching.php', [
    'namespace aint\mvc\dispatching' => 'namespace ' . __NAMESPACE__,
    'function dispatch_http(' => 'function run_not_needed(',
    ' routing\route_root(' => ' \\' . __NAMESPACE__ . '\routing_route_root(',
]);

function routing_route_root($request, $default_index_action) {
    return [$request, $default_index_action];
}

function dispatch_http($routers, $actions_namespace, $error_handler) {
    dispatching_dispatch_http_default_router_test::$run_params = [
        $routers, $actions_namespace, $error_handler
    ];
}

use tests\aint\mvc\dispatching_dispatch_http_default_router_test as dispatching;

class dispatching_dispatch_http_default_router_test extends \PHPUnit_Framework_TestCase {

    public static $run_params;

    public function test_run_default() {
        // testing that run_default function creates a callable wrapping route_root
        // using default_index_action
        // also testing that the function calls "run" function from the same package
        // with parameters required
        $error_handler = function() {};
        dispatching\dispatch_http_default_router('actions_namespace', $error_handler);
        $this->assertEquals('actions_namespace', self::$run_params[1]);
        $this->assertEquals($error_handler, self::$run_params[2]);
        $routers = self::$run_params[0];
        $this->assertEquals('\aint\mvc\routing\route_segment', $routers[0]);
    }

}