<?php
/**
 * Common, general purpose functions
 */
namespace aint\common;

/**
 * Checks if $name parameter is set in $data array
 * returns its value if yes, and if not - returns $default
 *
 * No notice or warning is ever triggered
 */
function get_param(array $data, int|string $name, mixed $default = null): mixed {
    return array_key_exists($name, $data)
        ? $data[$name] : $default;
}

/**
 * Merges two arrays recursively
 */
function merge_recursive(array $config1, array $config2): array {
    foreach ($config2 as $key => $value)
        if (array_key_exists($key, $config1))
            if (is_int($key))
                $config1[] = $value;
            elseif (is_array($value))
                $config1[$key] = merge_recursive($config1[$key], $value);
            else
                $config1[$key] = $value;
        else
            $config1[$key] = $value;
    return $config1;
}
