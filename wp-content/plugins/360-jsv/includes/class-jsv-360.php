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
        $this->define_admin_hooks();
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
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-jsv-360-admin.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'widgets/class-jsv-360-widget.php';

        $this->loader = new JSV_360_Loader();
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {

        $plugin_admin = new JSV_360_Admin( $this->pluginName, $this->version );

        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        $this->loader->add_action( 'admin_menu', $plugin_admin, 'load_menu' );
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
        $widget = new JSV_360_Widget();

        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_scripts');
        $this->loader->add_action('widgets_init', $widget, 'register');

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