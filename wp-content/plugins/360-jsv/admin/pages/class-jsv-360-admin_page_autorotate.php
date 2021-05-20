<?php

class JSV_360_ADMIN_AUTOROTATE extends JSV_360_ADMIN_PAGE_ABSTRACT
{
    const PATH = 'jsv-autorotate-settings';

    protected $pageTitle = 'Autorotate at start';
    protected $menuTitle = 'Autorotate';
    protected $template = 'jsv-360-admin-display-autorotate';

    const AUTOROTATE = 'jsv360_autorotate';

    protected $fields = [
        self::AUTOROTATE
    ];
}