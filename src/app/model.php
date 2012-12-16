<?php
namespace app\model;

require_once 'aint/common.php';
use aint\common;

const app_config = '/model/configs/app.inc';
const app_local_config = '/model/configs/app.local.inc';
const default_locale = 'en_US';
const languages_path = 'app/model/languages/';
const locale_file_ext = '.inc';

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

function translate($text, $locale = default_locale) {
    static $languages;
    if (!isset($languages[$locale]))
        $languages[$locale] = require languages_path . $locale . locale_file_ext;

    return common\get_param($languages[$locale], $text, $text);
}