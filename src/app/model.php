<?php
namespace app\model;

require_once 'aint/common.php';
use aint\common;

/**
 * Application model configuration
 */
const app_config = '/model/configs/app.inc',
      app_local_config = '/model/configs/app.local.inc';

/**
 * Localization parameters
 */
const default_locale = 'en_US',
      languages_path = 'app/model/languages/',
      locale_file_ext = '.inc';

/**
 * Returns main application configuration
 * (merged with app.local.ini if one exists)
 *
 * @return array
 */
function get_app_config() {
    static $config;
    if ($config === null) {
        $app_dir = dirname(__FILE__);
        $config = require $app_dir . app_config;
        if (is_readable($local_config = $app_dir . app_local_config))
            $config = common\merge_recursive($config, require $local_config);
    }
    return $config;
}

/**
 * Translates a string using a language file for the locale specified
 * returns the string itself if no translation is found
 *
 * @param $text
 * @param string $locale
 * @return string
 */
function translate($text, $locale = default_locale) {
    static $languages = [];
    if (!isset($languages[$locale]))
        $languages[$locale] = require languages_path . $locale . locale_file_ext;

    return common\get_param($languages[$locale], $text, $text);
}