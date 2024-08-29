<?php

class JSV_360_Public_Woo_Factory
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

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

    public function create($theme)
    {
        require_once dirname(__FILE__) . '/themes/class-jsv-360-public-woo-base.php';

        switch ($theme) {
            case 'Twenty Twenty-Three':
            case 'Twenty Twenty-Four':
                require_once dirname(__FILE__) . '/themes/twentytwentythree/class-jsv-360-public-woo-twentytwentythree.php';
                return new JSV_360_Public_Woo_TwentyTwentyThree($this->plugin_name, $this->version);
            case 'Flatsome':
                require_once dirname(__FILE__) . '/themes/flatsome/class-jsv-360-public-woo-flatsome.php';
                return new JSV_360_Public_Woo_Flatsome($this->plugin_name, $this->version);
            default:
                require_once dirname(__FILE__) . '/themes/twentytwentythree//class-jsv-360-public-woo-twentytwentythree.php';
                return new JSV_360_Public_Woo_TwentyTwentyThree($this->plugin_name, $this->version);
        }
    }
}