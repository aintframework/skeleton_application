<?php

namespace app\controller\actions\errors;

use app\view;
use aint\mvc\dispatching;
use aint\http;
use exception;

/**
 * Error handler, this function is called if something happens
 * during the dispatch process
 */
function error_action(array $request, array $params, exception $error): array
{
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
