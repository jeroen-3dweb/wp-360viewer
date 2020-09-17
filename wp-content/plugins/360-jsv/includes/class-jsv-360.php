<?php

class JSV_360
{
    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $pluginName;

    /**
     * @var JSV_360_Loader
     */
    private $loader;

    /**
     * JSV constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        if (defined('JSV_VERSION')) {
            $this->version = JSV360_VERSION;
        } else {
            $this->version = '1.0.0';
        }

        $this->pluginName = '360 jsv';

        $this->loadDependencies();
        $this->definePublicHooks();
    }

    /**
     * Load dependencies
     *
     * @since    1.0.0
     * @access   private
     */
    private function loadDependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-jsv-360-loader.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-jsv-360-parser.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-jsv-360-public.php';

        $this->loader = new JSV_360_Loader();
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
        $pluginPublic = new JSV_360_Public($this->pluginName, $this->version);
        $parser       = new JSV_360_Parser($this->pluginName, $this->version);

        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_scripts');

        $this->loader->add_filter('the_content', $parser, 'parse');
    }

    /**
     * @since 1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }
}