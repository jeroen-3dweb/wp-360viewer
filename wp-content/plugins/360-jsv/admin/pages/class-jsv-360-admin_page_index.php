<?php

class JSV_360_ADMIN_INDEX implements JSV_360_ADMIN_PAGE_INTERFACE
{



    public function loadMenuItem($mainSlug)
    {
        add_menu_page(
            '360 Javascript Viewer Setting',
            '360 Javascript Viewer',
            'manage_options',
            $mainSlug,
            [$this, 'init_360_admin'],
            plugin_dir_url( __FILE__ ) . '../img/sign-36-bw.svg'
        );
    }


    public function init_360_admin()
    {
        echo require(__DIR__ . '/../partials/jsv-360-admin-display.php');
    }

    public function loadHooks()
    {
        // TODO: Implement loadHooks() method.
    }
}