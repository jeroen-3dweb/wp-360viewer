<?php
/*
Plugin Name: 360&deg; Javascript Viewer
Plugin URI: https://www.360-javascriptviewer.com
Description: Small 360 Product Viewer. Creates a 360 product view from a series of photos. Check for examples at https://www-360-javascriptviewer.com
Author: 360 Javascript Viewer
Author URI: https://www.360-javascriptviewer.com/
Developer: Jeroen Termaat
Developer URI: https://www.360-javscriptviewer.com/
Version: 1.5.1
Last Modified: 2020-08-28
License: GPLv2
*/

if (!defined('WPINC')) {
    die;
}

if ( ! function_exists( 'jsv_360viewer' ) ) {
    // Create a helper function for easy SDK access.
    function jsv360_viewer() {
        global $jsv360_viewer;

        if ( ! isset( $jsv360_viewer ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $jsv360_viewer = fs_dynamic_init( array(
                'id'                  => '6844',
                'slug'                => '360deg-javascript-viewer',
                'type'                => 'plugin',
                'public_key'          => 'pk_fee47e6ac1ee46ff1b2373fa23500',
                'is_premium'          => false,
                'has_addons'          => false,
                'has_paid_plans'      => false,
                'menu'                => array(
                    'first-path'     => 'plugins.php',
                    'support'        => false,
                ),
            ) );
        }

        return $jsv360_viewer;
    }

    // Init Freemius.
    jsv360_viewer();
    // Signal that SDK was initiated.
    do_action( 'jsv_viewer_loaded' );
}

define('JSV360_VERSION', '1.5.1');
define('JSV360_PATH', plugin_dir_path(__FILE__));
define('JSV360_MAIN_URL', __FILE__);

require plugin_dir_path(__FILE__) . 'includes/class-jsv-360.php';

function run_jsv360()
{
    (new JSV_360())->run();
}

run_jsv360();