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
        $this->loadPages();
        $this->loadAjaxHooks();
    }

    private function loadAjaxHooks()
    {
        add_action('wp_ajax_jsv_save_settings', array($this, 'save_settings'));
        add_action('wp_ajax_nopriv_jsv_save_settings', array($this, 'save_settings'));
    }

    public function save_settings()
    {
        if (isset($_POST['jsv_notifier_image'])) {
            $jsvNotifierImage = _sanitize_text_fields($_POST['jsv_notifier_image']);
            update_option(self::NOTIFIER_IMAGE_ID, $jsvNotifierImage);
        }
        if (isset($_POST['jsv_license'])) {
            $jsvLicense = _sanitize_text_fields($_POST['jsv_license']);
            update_option(self::NOTIFIER_LICENSE, $jsvLicense);
        }
        wp_send_json_success('success');
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
            plugin_dir_url(__FILE__) . 'css/jsv-360-admin.css',
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
    public function enqueue_scripts()
    {
        if (!did_action('wp_enqueue_media')) {
            wp_enqueue_media();
        }
        wp_enqueue_script('jsv-upload', plugin_dir_url(__FILE__) . 'js/upload.js', array('jquery'), $this->version);

        wp_localize_script(
            'jsv-upload',
            'jsvUpload',
            [
                'ajaxUrl'  => admin_url('admin-ajax.php'),
                'security' => wp_create_nonce('jsv_save_setting'),
            ]
        );
    }


    public function loadPageMenu()
    {
        /** @var JSV_360_ADMIN_PAGE_INTERFACE $page */
        foreach ($this->pages as $page) {
            $page->loadMenuItem(self::PLUGIN_MENU_SLUG);
        }
    }

    public function load_startup()
    {
        if (get_option(self::REDIRECT_OPTION_NAME, false)) {
            delete_option(self::REDIRECT_OPTION_NAME);
            if (!isset($_GET['activate-multi'])) {
                wp_redirect("admin.php?page=360-javascript-viewer");
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
        require_once $path . DIRECTORY_SEPARATOR . 'class-jsv-360-admin_page_interface.php';

        foreach (scandir($path) as $memberFile) {
            if (strlen($memberFile) > 10) {
                require_once($path . DIRECTORY_SEPARATOR . $memberFile);
            }
        }
        $this->pages = [
            new JSV_360_ADMIN_INDEX(),
            new JSV_360_ADMIN_NOTIFIER(),
            new JSV_360_ADMIN_LICENSE()
        ];
    }
}