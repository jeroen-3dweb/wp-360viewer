<?php

class JSV_360_ADMIN_ACF extends JSV_360_ADMIN_PAGE_ABSTRACT
{
    const PATH = 'jsv-acf-settings';

    protected $pageTitle = 'Advanced Custom Fields';
    protected $menuTitle = 'ACF Settings';
    protected $template = 'jsv-360-admin-display-acf';

    const ACF_FIELD = 'jsv360_acf_field';

    protected $fields = [
        self::ACF_FIELD
    ];
}