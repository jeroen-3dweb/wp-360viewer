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

if (!defined('WPINC')) {
    die;
}

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
                                               'premium_slug'        => '360-jsv-premium',
                                               'type'                => 'plugin',
                                               'public_key'          => 'pk_fee47e6ac1ee46ff1b2373fa23500',
                                               'is_premium'          => true,
                                               'premium_suffix'      => 'Business',
                                               // If your plugin is a serviceware, set this option to false.
                                               'has_premium_version' => true,
                                               'has_addons'          => false,
                                               'has_paid_plans'      => true,
                                               'trial'               => array(
                                                   'days'               => 14,
                                                   'is_require_payment' => false,
                                               ),
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


define('JSV_VERSION', '1.0.0');

require plugin_dir_path(__FILE__) . 'includes/class-360-jsv.php';

function run_360_jsv()
{
    (new JSV())->run();
}

run_360_jsv();