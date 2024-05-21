<?php

class JSV_360_ADMIN_WOOCOMMERCE extends JSV_360_ADMIN_PAGE_ABSTRACT
{
    const PATH = 'jsv-woocommerce-settings';

    protected $pageTitle = 'WooCommerce settings';
    protected $menuTitle = 'WooCommerce';
    protected $template = 'jsv-360-admin-display-woocommerce';

    const ALTER_GALLERY = 'jsv360_alter_gallery';

    protected $fields = [
        self::ALTER_GALLERY,
    ];

    protected $checkBoxes = [
        self::ALTER_GALLERY,
    ];
}