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

if ( ! function_exists( 'jsv_viewer' ) ) {
    // Create a helper function for easy SDK access.
    function jsv_viewer() {
        global $jsv_viewer;

        if ( ! isset( $jsv_viewer ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $jsv_viewer = fs_dynamic_init( array(
                'id'                  => '6844',
                'slug'                => '360-javascriptviewer',
                'type'                => 'plugin',
                'public_key'          => 'pk_fee47e6ac1ee46ff1b2373fa23500',
                'is_premium'          => true,
                'premium_suffix'      => 'Business',
                // If your plugin is a serviceware, set this option to false.
                'has_premium_version' => true,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'menu'                => array(
                    'first-path'     => 'plugins.php',
                    'support'        => false,
                ),
                // Set the SDK to work in a sandbox mode (for development & testing).
                // IMPORTANT: MAKE SURE TO REMOVE SECRET KEY BEFORE DEPLOYMENT.
                'secret_key'          => 'sk_P%xNq#9MpD]R?a)E?(!b2g7C[[YHN',
            ) );
        }

        return $jsv_viewer;
    }

    // Init Freemius.
    jsv_viewer();
    // Signal that SDK was initiated.
    do_action( 'jsv_viewer_loaded' );
}

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


