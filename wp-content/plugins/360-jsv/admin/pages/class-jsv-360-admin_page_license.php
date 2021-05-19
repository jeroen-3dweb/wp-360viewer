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
}