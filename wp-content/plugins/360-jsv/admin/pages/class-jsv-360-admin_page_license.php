<?php

class JSV_360_ADMIN_LICENSE implements JSV_360_ADMIN_PAGE_INTERFACE
{
    const NOTIFIER_LICENSE = 'jsv360_license';
    const PATH = 'jsv-license-settings';

    public function loadMenuItem($mainSlug)
    {
        add_submenu_page(
            $mainSlug,
            'License Settings',
            'License',
            'manage_options',
            self::PATH,
            [$this, 'init_360_admin']
        );
    }

    public function init_360_admin()
    {
        $source = self::PATH;

        echo require(__DIR__ . '/../partials/jsv-360-admin-display-license.php');
    }


    public function save_settings()
    {
        if (isset($_POST['jsv_license'])) {
            $jsvLicense = _sanitize_text_fields($_POST['jsv_license']);
            update_option(self::NOTIFIER_LICENSE, $jsvLicense);
        }
        wp_send_json_success('success');
    }

    public function loadHooks()
    {
        add_action('wp_ajax_jsv_save_settings', array($this, 'save_settings'));
        add_action('wp_ajax_nopriv_jsv_save_settings', array($this, 'save_settings'));
    }
}