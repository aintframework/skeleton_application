<?php
namespace app\controller\actions\errors;

require_once 'app/view.php';
use app\view; 
require_once 'aint/mvc/dispatching.php';
use aint\mvc\dispatching;
require_once 'aint/http.php';
use aint\http;
require_once 'aint/common.php';
use aint\common; // todo: consider aint\error namespace for common error

function error_action($request, $params, \exception $error) {
    if ($error instanceof dispatching\not_found_error) {
        $status = 404;
        $message = 'Page ' . $request[http\request_path] . ' is not found';
    } else {
        $status = 500;
        $message = 'System error';
        error_log(get_class($error) . ' ' . $error->getMessage());
    }
    $response = view\render('errors/error', ['message' => $message]);
    $response[http\response_status] = $status; // todo: add a function
    return $response;
}