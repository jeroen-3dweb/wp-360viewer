<?php

class JSV_360_Admin
{
    const REDIRECT_OPTION_NAME = 'jsv360_do_activation_redirect';

    const PLUGIN_MENU_SLUG = 'jsv-main-settings';

    private $pluginName;

    private $version;
    private $pages = [];


    /**
     * JSV_360_Admin constructor.
     * @param $pluginName
     * @param $version
     */
    public function __construct($pluginName, $version)
    {
        $this->pluginName = $pluginName;
        $this->version    = $version;
        $this->loadHelpers();
        $this->loadPages();
        $this->loadHooks();
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style(
            $this->pluginName,
            plugin_dir_url(__FILE__) . 'scss/jsv-360-admin.css',
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
    public function enqueue_scripts($hook)
    {
        if (!did_action('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        wp_enqueue_script('jsv-admin', plugin_dir_url(__FILE__) . 'js/admin.js', array('jquery'), $this->version);

        if(strpos($hook, 'page_jsv-') === false){
            return;
        }

        wp_localize_script(
            'jsv-admin',
            'jsvUpload',
            [
                'ajaxUrl'  => admin_url('admin-ajax.php'),
                'security' => wp_create_nonce('jsv_save_setting'),
            ]
        );
    }


    public function loadPageMenu()
    {
        /** @var JSV_360_ADMIN_PAGE_ABSTRACT $page */
        foreach ($this->pages as $page) {
            $page->loadMenuItem(self::PLUGIN_MENU_SLUG);
        }
    }
    public function loadHooks()
    {
        /** @var JSV_360_ADMIN_PAGE_ABSTRACT $page */
        foreach ($this->pages as $page) {
            $page->loadHooks();
        }
    }

    public function load_startup()
    {
        if (get_option(self::REDIRECT_OPTION_NAME, false)) {
            delete_option(self::REDIRECT_OPTION_NAME);
            if (!isset($_GET['activate-multi'])) {
                wp_redirect("admin.php?page=jsv-main-settings");
            }
        }
    }

    public function activation()
    {
        add_option(self::REDIRECT_OPTION_NAME, true);
    }

    public function de_activation()
    {
        delete_option(self::REDIRECT_OPTION_NAME);
    }

    /**
     * Load pages for the admin menu
     */
    private function loadPages()
    {
        $path = plugin_dir_path(dirname(__FILE__)) . 'admin/pages/';
        require_once $path . DIRECTORY_SEPARATOR . 'class-jsv-360-admin_page_abstract.php';

        foreach (scandir($path) as $memberFile) {
            if (strlen($memberFile) > 10) {
                require_once($path . DIRECTORY_SEPARATOR . $memberFile);
            }
        }
        $this->pages = [
            new JSV_360_ADMIN_INDEX(),
            new JSV_360_ADMIN_CLOUD(),
            new JSV_360_ADMIN_DEDICATED(),
            new JSV_360_ADMIN_NOTIFIER(),
            new JSV_360_ADMIN_AUTOROTATE(),
            new JSV_360_ADMIN_ACF(),
            new JSV_360_ADMIN_WOOCOMMERCE(),
            new JSV_360_ADMIN_LICENSE(),
            new JSV_360_ADMIN_ABOUT(),
        ];
    }

    private function loadHelpers()
    {
        $path = plugin_dir_path(dirname(__FILE__)) . 'admin/helpers/';

        foreach (scandir($path) as $memberFile) {
            if (strlen($memberFile) > 10) {
                require_once($path . DIRECTORY_SEPARATOR . $memberFile);
            }
        }
    }
}