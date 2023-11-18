<?php
/**
 * HTTP-related functions
 */
namespace aint\http;

/**
 * Http Request data
 */
const request_scheme = 'scheme',
      request_body = 'body',
      request_path = 'path',
      request_params = 'params',
      request_method = 'method',
      request_headers = 'headers';

/**
 * Http Response data
 */
const response_body = 'body',
      response_headers = 'headers',
      response_status = 'status';

/**
 * Http Request method types
 */
const request_method_post = 'POST',
      request_method_get = 'GET',
      request_method_put = 'PUT',
      request_method_delete = 'DELETE';

/**
 * Retrieves data about the current HTTP request using PHP's global arrays
 */
function build_request_from_globals(): array {
    $path = $_SERVER['REQUEST_URI'];
    if (($separator_position = strpos($path, '?')) !== false)
        $path = substr($path, 0, $separator_position);
    return [
        request_scheme => empty($_SERVER['HTTPS']) ? 'http' : 'https',
        request_body => file_get_contents("php://input"),
        request_path => trim($path, '/'),
        request_params => array_merge($_GET, $_POST), // todo make these separate, provide functions
        request_method => $_SERVER['REQUEST_METHOD'],
        request_headers => get_headers_from_globals(),
    ];
}

/**
 * Whether the request is a POST
 */
function is_post(array $request): bool {
    return $request[request_method] === request_method_post;
}

/**
 * Whether the request is a GET
 */
function is_get(array $request): bool {
    return $request[request_method] === request_method_get;
}

/**
 * Whether the request is a DELETE
 */
function is_delete(array $request): bool {
    return $request[request_method] === request_method_delete;
}

/**
 * Whether the request is a PUT
 */
function is_put(array $request): bool {
    return $request[request_method] === request_method_put;
}

/**
 * Prepares data for HTTP response based on the parameters passed
 */
function build_response(string $body = '', int $code = 200, array $headers = []): array {
    return [
        response_body => $body,
        response_status => $code,
        response_headers => $headers
    ];
}

/**
 * Prepares default response data and sets it to be redirected to location specified
 */
function build_redirect(string $location): array {
    return redirect(build_response(), $location);
}

/**
 * Sets the response data passed to be redirected to location specified
 */
function redirect(array $response, string $location): array {
    array_push($response[response_headers], 'Location: ' . $location);
    $response[response_status] = 302;
    return $response;
}

/**
 * Adds cookie header to the response array passed
 */
function add_cookie_header(array $response, ?string $name = null, ?string $value = null, ?int $expires = null, ?string $path = null, ?string $domain = null,
                           bool $secure = false, bool $http_only = false, ?string $max_age = null, ?string $version = null) {
    if (strpos($value, '"')!==false)
        $value = '"' . urlencode(str_replace('"', '', $value)) . '"';
    else
        $value = urlencode($value);

    $cookie_string = $name . '=' . $value;
    if ($version !== null)
        $cookie_string .= '; Version=' . $version;
    if ($max_age !== null)
        $cookie_string .= '; Max-Age=' . $max_age;
    if ($expires !== null)
        $cookie_string .= '; Expires=' . date(DATE_COOKIE, $expires);
    if ($domain !== null)
        $cookie_string .= '; Domain=' . $domain;
    if ($path !== null)
        $cookie_string .= '; Path=' . $path;
    if ($secure)
        $cookie_string .= '; Secure';
    if ($http_only)
        $cookie_string .= '; HttpOnly';

    $response[response_headers][] = 'Set-Cookie: ' . $cookie_string;
    return $response;
}

/**
 * Returns value of a cookie by name
 */
function get_cookie_value(array $request, string $name): mixed {
    if (isset($request[request_headers]['Cookie'])) {
        $key_value_pairs = preg_split('#;\s*#', $request[request_headers]['Cookie']);
        foreach ($key_value_pairs as $key_value) {
            list($key, $value) = preg_split('#=\s*#', $key_value, 2);
            if ($key == $name)
                return $value;
        }
    }
    return null;
}

/**
 * Outputs response data
 */
function send_response(array $response): void {
    header('HTTP/1.1 ' . $response[response_status]);
    array_walk($response[response_headers], 'header');
    echo $response[response_body];
}

/**
 * Changes HTTP status in response data
 */
function response_status(array $response, int $status): array {
    $response[response_status] = $status;
    return $response;
}

/**
 * Extracts http headers from current context
 *
 * Uses getallheaders function if available
 */
function get_headers_from_globals(): array {
    if (function_exists('getallheaders'))
        return getallheaders();
    else {
        $headers = [];
        foreach($_SERVER as $header => $value)
            if (strpos($header, 'HTTP_') === 0) {
                $formatted_header_name =
                    str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($header, 5)))));
                $headers[$formatted_header_name] = $value;
            }
        return $headers;
    }
}
