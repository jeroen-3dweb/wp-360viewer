<?php

class JSV_360_ADMIN_LICENSE extends JSV_360_ADMIN_PAGE_ABSTRACT
{
    const PATH = 'jsv-license-settings';

    protected $pageTitle = 'License & branding';
    protected $menuTitle = 'License & branding';
    protected $template = 'jsv-360-admin-display-license';

    const NOTIFIER_LICENSE = 'jsv360_license';

    protected $fields = [
        self::NOTIFIER_LICENSE
    ];
}
