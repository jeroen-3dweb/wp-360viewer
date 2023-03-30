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
     * @param $version
     * @since 1.0.0
     */
    public function __construct($version)
    {
        $this->version = $version;

        $this->pluginName = '360 jsv';

        $this->loadDependencies();
        $this->definePublicHooks();
        $this->define_admin_hooks();

        $this->loadPluginHooks();
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
        require_once plugin_dir_path(dirname(__FILE__)) . 'blocks/class-jsv-360-block.php';

        //  Plugins
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/woo/class-jsv-360-woo.php'; //woo

        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/elementor/class-jsv-360-elementor.php'; //Elementor

        $this->loader = new JSV_360_Loader();
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new JSV_360_Admin($this->pluginName, $this->version);

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

        $this->loader->add_action('admin_menu', $plugin_admin, 'loadPageMenu');

        register_activation_hook(JSV360_MAIN_URL, [$plugin_admin, 'activation']);
        register_deactivation_hook(JSV360_MAIN_URL, [$plugin_admin, 'de_activation']);

        $this->loader->add_action('admin_init', $plugin_admin, 'load_startup');
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
        $widget       = new JSV_360_Widget();
        $block       = new JSV_360_Block($this->pluginName, $this->version);

        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueue_scripts');
        $this->loader->add_action('widgets_init', $widget, 'register');
        $this->loader->add_action('init', $block, 'register');

        $this->loader->add_filter('the_content', $parser, 'parse');
    }

    /**
     * @since 1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    private function loadPluginHooks()
    {
        // Woocommerce
        if (JSV_360_WOO::woocommerceIsActive()) {
            (new JSV_360_WOO($this->version, $this->pluginName, $this->loader))->run();
        }

        // Elementor
        if (JSV_360_Elementor::elementorIsActive()) {
            (new JSV_360_Elementor($this->version, $this->pluginName, $this->loader))->run();
        }
    }
}