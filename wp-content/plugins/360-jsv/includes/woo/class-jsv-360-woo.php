<?php

class JSV_360_WOO
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
     * @param $pluginName
     * @param JSV_360_Loader $loader
     * @since 1.0.0
     */
    public function __construct($version, $pluginName, JSV_360_Loader $loader)
    {
        $this->version = $version;
        $this->pluginName = $pluginName;

        $this->loader = $loader;
    }

    /**
     * Load dependencies
     *
     * @since    1.0.0
     * @access   private
     */
    private function loadDependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . '/../public/class-jsv-360-public-woo-factory.php';
        require_once plugin_dir_path(dirname(__FILE__)) . '/woo/class-jsv-360-woo-metabox.php';
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
        $metaBox = new JSV_360_WOO_METABOX($this->pluginName, $this->version);
        $this->loader->add_action('add_meta_boxes', $metaBox, 'addBoxes');
        $this->loader->add_action('save_post', $metaBox, 'saveBoxes');
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
        $currentTheme = wp_get_theme();
        $pluginPublicWoo = (new JSV_360_Public_Woo_Factory($this->pluginName, $this->version))->create($currentTheme->get('Name'));

        $alterWooCommerce = (int)get_option(JSV_360_ADMIN_WOOCOMMERCE::ALTER_GALLERY, 1);
        if ($alterWooCommerce === 1) {
            $this->loader->add_filter(
                'woocommerce_single_product_image_thumbnail_html',
                $pluginPublicWoo,
                'add_360_icon',
                10,
                2
            );

            $this->loader->add_action('wp_enqueue_scripts', $pluginPublicWoo, 'enqueue_scripts');
            $this->loader->add_action('wp_enqueue_scripts', $pluginPublicWoo, 'enqueue_styles');
        }
    }

    /**
     * @since 1.0.0
     */
    public function run()
    {
        $this->loadDependencies();
        $this->definePublicHooks();
        $this->define_admin_hooks();
    }

    /**
     * @return bool
     */
    public static function woocommerceIsActive()
    {
        return in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')));
    }
}