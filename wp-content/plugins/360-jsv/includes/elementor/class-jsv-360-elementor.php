<?php

class JSV_360_ELEMENTOR
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
        $this->version    = $version;
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
        require_once JSV360_PATH . 'widgets/elementor/class-jsv-360-elementor-widget.php';
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function definePublicHooks(){

        $this->loader->add_action( 'elementor/widgets/register', $this,'registerWidgets' );
    }

    public function registerWidgets($widgetsManager) {
        $this->loadDependencies();
        $widgetsManager->register( new JSV_360_ELEMENTOR_WIDGET());
    }

    /**
     * @since 1.0.0
     */
    public function run()
    {
        $this->definePublicHooks();
    }

    /**
     * @return bool
     */
    public static function elementorIsActive()
    {
        return in_array('elementor/elementor.php', apply_filters('active_plugins', get_option('active_plugins')));
    }
}