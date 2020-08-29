<?php

class JSV
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
     * @var JSV_Loader
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
            $this->version = JSV_VERSION;
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
     * @since 1.0.0
     */
    private function loadDependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-360-jsv-loader.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-360-jsv-parser.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-360-jsv-public.php';

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
        $parser       = new JSV_Parser($this->pluginName, $this->version);

        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_scripts');

        $this->loader->add_filter('the_content', $parser, 'parse');
    }

    public function run()
    {
        $this->loader->run();
    }
}