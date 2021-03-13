<?php
/*
Plugin Name: 360&deg; Javascript Viewer
Plugin URI: https://www.360-javascriptviewer.com
Description: Small 360 Product Viewer. Creates a 360 product view from a series of photos. Check for examples at https://www-360-javascriptviewer.com
Author: 360 Javascript Viewer
Author URI: https://www.360-javascriptviewer.com/
Developer: Jeroen Termaat
Developer URI: https://www.360-javscriptviewer.com/
Version: 1.6.3
Last Modified: 2020-08-28
License: GPLv2
*/

if (!defined('WPINC')) {
    die;
}
$jsvVersion = '1.6.3';
define('JSV360_VERSION', $jsvVersion);
define('JSV360_PATH', plugin_dir_path(__FILE__));
define('JSV360_MAIN_URL', __FILE__);

require plugin_dir_path(__FILE__) . 'includes/class-jsv-360.php';

function run_jsv360($version)
{
    (new JSV_360($version))->run();
}

run_jsv360($jsvVersion);