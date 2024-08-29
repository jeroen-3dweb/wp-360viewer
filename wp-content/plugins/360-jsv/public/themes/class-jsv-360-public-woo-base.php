<?php

abstract class JSV_360_Public_Woo_Base
{
    const THEME_NAME = 'base';

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    protected $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    protected $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    protected function generateId()
    {
        $permitted_chars = implode('', range('a', 'z'));
        return 'jsv-' . '-' . substr(str_shuffle($permitted_chars), 0, 10);
    }

    abstract public function add_360_icon($d, $e);


    protected function getBBCode()
    {
        /** @var WC_Product $product */
        global $product;
        return $product ? $product->get_meta(JSV_360_WOO_METABOX::FIELD_BBCODE) ?: null : null;
    }


    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.5.0
     */
    protected function enqueue_scripts_based_on_theme($theme)
    {
        $path = sprintf('%s/%s/woo_%s.js', plugin_dir_url(__FILE__), $theme, $theme);

        wp_enqueue_script(
            $this->plugin_name . '_woo_js',
            $path,
            array('javascriptviewer'),
            $this->version
        );
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.5.0
     */
    public function enqueue_styles_based_on_theme($theme)
    {
        $path = sprintf('%s/%s/woo_%s.css', plugin_dir_url(__FILE__), $theme, $theme);
        wp_enqueue_style(
            $this->plugin_name . '_woo_css',
            $path,
            array(),
            $this->version,
            'all'
        );
    }

    public function enqueue_styles()
    {
        $this->enqueue_styles_based_on_theme(static::THEME_NAME);;
    }

    public function enqueue_scripts()
    {
        $this->enqueue_scripts_based_on_theme(static::THEME_NAME);
    }
}