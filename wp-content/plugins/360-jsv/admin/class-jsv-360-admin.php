<?php

class JSV_360_Admin
{
    const REDIRECT_OPTION_NAME = 'jsv360_do_activation_redirect';
    const NOTIFIER_IMAGE_ID = 'jsv360_notifier_image_id';

    private $pluginName;

    private $version;


    /**
     * JSV_360_Admin constructor.
     * @param $pluginName
     * @param $version
     */
    public function __construct($pluginName, $version)
    {
        $this->pluginName = $pluginName;
        $this->version    = $version;

        $this->loadAjaxHooks();
    }

    private function loadAjaxHooks()
    {
        add_action('wp_ajax_jsv_save_settings', array($this, 'save_settings'));
        add_action('wp_ajax_nopriv_jsv_save_settings', array($this, 'save_settings'));
    }

    public function save_settings()
    {
        $jsvNotifierImage= _sanitize_text_fields($_POST['jsv_notifier_image']);
        update_option(self::NOTIFIER_IMAGE_ID, $jsvNotifierImage);
        wp_send_json_success( 'Ajax here!' );
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Plugin_Name_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Plugin_Name_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

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
        wp_enqueue_script('jsv-upload', plugin_dir_url(__FILE__) . '/js/upload.js', array('jquery'));

        wp_localize_script(
            'jsv-upload',
            'jsvUpload',
            [
                'ajaxUrl'  => admin_url('admin-ajax.php'),
                'security' => wp_create_nonce('jsv_save_setting'),
            ]
        );
    }

    public function init_360_admin()
    {
        $image_id = get_option(self::NOTIFIER_IMAGE_ID, null);
        echo require(__DIR__ . '/partials/jsv-360-admin-display.php');
    }

    public function load_menu()
    {
        add_menu_page(
            '360 Javascript Viewer Setting',
            '360 Javascript Viewer',
            'manage_options',
            '360-javascript-viewer',
            [$this, 'init_360_admin']
        );
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


}