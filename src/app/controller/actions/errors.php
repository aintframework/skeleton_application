<?php
namespace app\controller\actions\errors;

require_once 'app/view.php';
use app\view; 
require_once 'aint/mvc/dispatching.php';
use aint\mvc\dispatching;
require_once 'aint/http.php';
use aint\http;
require_once 'aint/common.php';
use aint\common;

/**
 * Error handler, this function is called if something happens
 * during the dispatch process
 *
 * @param $request
 * @param $params
 * @param \exception $error
 * @return array
 */
function error_action($request, $params, \exception $error) {
    if ($error instanceof dispatching\not_found_error) {
        $status = 404;
        $message = 'Page ' . $request[http\request_path] . ' is not found';
    } else {
        $status = 500;
        $message = 'System error';
        error_log(get_class($error) . ' ' . $error->getMessage());
    }
    $response = http\response_status(
        view\render('errors/error', ['message' => $message]),
        $status
    );

    return $response;
}