<?php
/*
Plugin Name: 360&deg; Javascript Viewer
Plugin URI: https://www.360-javascriptviewer.com
Description: Small 360 Product Viewer. Creates a 360 product view from a series of photos. Check for examples at https://www-360-javascriptviewer.com
Author: 3DWeb
Author URI: https://www.360-javascriptviewer.com/
Developer: Jeroen Termaat
Developer URI: https://www.360-javscriptviewer.com/
Version: 1.0.0
Last Modified: 2020-08-28
License: GPLv2
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('JSV_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_360_jsv()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-360-jsv-activator.php';
    JSV_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_360_jsv()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-360-jsv-deactivator.php';
    JSV_Deactivator::deActivate();
}

register_activation_hook(__FILE__, 'activate_360_jsv');
register_deactivation_hook(__FILE__, 'deactivate_360_jsv');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-360-jsv.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_360_jsv()
{
    (new JSV())->run();
}

run_360_jsv();


