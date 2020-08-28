<?php

class JSV
{

    private $version;
    /**
     * @var string
     */
    private $pluginName;
    /**
     * @var JSV_Loader
     */
    private $loader;

    public function __construct()
    {
        if (defined('JSV_VERSION')) {
            $this->version = JSV_VERSION;
        } else {
            $this->version = '1.0.0';
        }

        $this->pluginName = '360 jsv';

        $this->loadDependencies();
        $this->definePublicHooks();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
     * - Plugin_Name_i18n. Defines internationalization functionality.
     * - Plugin_Name_Admin. Defines all hooks for the admin area.
     * - Plugin_Name_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function loadDependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-360-jsv-loader.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-plugin-name-public.php';

        $this->loader = new JSV_Loader();
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function definePublicHooks()
    {
        $pluginPublic = new JSV_Public($this->pluginName, $this->version);

        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_scripts');
    }

    public function run()
    {
        $this->loader->run();
    }
}