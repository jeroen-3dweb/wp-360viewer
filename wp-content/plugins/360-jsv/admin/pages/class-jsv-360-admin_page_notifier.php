<?php

class JSV_360_ADMIN_NOTIFIER implements JSV_360_ADMIN_PAGE_INTERFACE
{
    const NOTIFIER_IMAGE_ID = 'jsv360_notifier_image_id';
    const PATH = 'jsv-notifier-settings';

    public function loadMenuItem($mainSlug)
    {
        add_submenu_page(
            $mainSlug,
            'Notifier Settings',
            'Notifier Settings',
            'manage_options',
            self::PATH,
            [$this, 'init_360_admin']
        );
    }

    public function init_360_admin()
    {
        $image_id = get_option(self::NOTIFIER_IMAGE_ID, null);
        echo require(__DIR__ . '/../partials/jsv-360-admin-display-notifier.php');
    }
}