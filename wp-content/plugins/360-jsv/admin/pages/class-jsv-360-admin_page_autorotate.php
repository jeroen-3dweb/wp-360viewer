<?php

class JSV_360_ADMIN_AUTOROTATE extends JSV_360_ADMIN_PAGE_ABSTRACT
{
    const PATH = 'jsv-autorotate-settings';

    protected $pageTitle = 'Autorotate at start';
    protected $menuTitle = 'Autorotate';
    protected $template = 'jsv-360-admin-display-autorotate';

    const AUTOROTATE = 'jsv360_autorotate';
    const AUTOROTATE_SPEED = 'jsv360_autorotate_speed';

    protected $fields = [
        self::AUTOROTATE,
        self::AUTOROTATE_SPEED
    ];
}