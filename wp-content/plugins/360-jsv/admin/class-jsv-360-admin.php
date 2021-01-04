<?php

class JSV_360_Admin
{
    private $pluginName;

    private $version;


    /**
     * JSV_360_Admin constructor.
     * @param $pluginName
     * @param $version
     */
    public function __construct($pluginName, $version)
    {
        $this->pluginName = $pluginName;
        $this->version    = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style(
            $this->pluginName,
            plugin_dir_url(__FILE__) . 'css/jsv-360-admin.css',
            array(),
            $this->version,
            'all'
        );
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
//
//        wp_enqueue_script(
//            $this->pluginName,
//            plugin_dir_url(__FILE__) . 'js/plugin-name-admin.js',
//            array('jquery'),
//            $this->version,
//            false
//        );
    }

    public function init_360_admin()
    {
        echo require(__DIR__ . '/partials/jsv-360-admin-display.php');
    }

    public function load_menu()
    {
        add_menu_page(
            '360 Javascript Viewer Setting',
            '360 Javascript Viewer',
            'manage_options',
            '360-javascript-viewer',
          [$this,'init_360_admin']
        );
    }


}