<?php
/*
Plugin Name: 360&deg; Javascript Viewer
Plugin URI: https://www.360-javascriptviewer.com
Description: Small 360 Product Viewer. Creates a 360 product view from a series of photos. Check for examples at https://www-360-javascriptviewer.com
Author: 360 Javascript Viewer
Author URI: https://360-javascriptviewer.com
Developer: Jeroen Termaat
Developer URI: https://www.360-javscriptviewer.com/
Version: 1.7.29
Last Modified: 2023-08-21
License: GPLv2
*/
error_reporting(E_ALL);
if (!defined('WPINC')) {
    die;
}
$jsvVersion = '1.7.29';
define('JSV360_VERSION', $jsvVersion);
define('JSV360_PATH', plugin_dir_path(__FILE__));
define('JSV360_MAIN_URL', __FILE__);
define('JSV360_DOMAIN', 'jsv-360');

require plugin_dir_path(__FILE__) . 'includes/class-jsv-360.php';

function run_jsv360($version)
{
    (new JSV_360($version))->run();
}

function parse_jsv360_shortcode($content, $reference = null, $overrides = [])
{
    echo (new JSV_360_Parser(JSV360_DOMAIN, JSV360_VERSION))->parse($content, $reference, $overrides);
}

run_jsv360($jsvVersion);