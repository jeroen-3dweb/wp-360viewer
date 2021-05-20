<?php

class JSV_360_ADMIN_LICENSE extends JSV_360_ADMIN_PAGE_ABSTRACT
{
    const PATH = 'jsv-license-settings';

    protected $pageTitle = 'Remove powered by';
    protected $menuTitle = 'Remove Powered By';
    protected $template = 'jsv-360-admin-display-license';

    const NOTIFIER_LICENSE = 'jsv360_license';

    protected $fields = [
        self::NOTIFIER_LICENSE
    ];
}