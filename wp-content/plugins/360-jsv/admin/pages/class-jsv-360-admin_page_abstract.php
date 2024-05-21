<?php

abstract class JSV_360_ADMIN_PAGE_ABSTRACT
{
    const PATH = '';
    protected $template = '';
    protected $fields = [];
    protected $checkBoxes = [];
    protected $pageTitle = 'n.a';
    protected $menuTitle = 'n.a';
    protected $isMainMenu = false;
    protected $customAjaxHooks = [];

    public function loadMenuItem($mainSlug)
    {
        if($this->isMainMenu){
            add_menu_page(
                $this->pageTitle,
                $this->menuTitle,
                'manage_options',
                $mainSlug,
                [$this, 'init'],
                plugin_dir_url( __FILE__ ) . '../img/sign-36-bw.svg'
            );
        }else {
            add_submenu_page(
                $mainSlug,
                $this->pageTitle,
                $this->menuTitle,
                'manage_options',
                $this::PATH,
                [$this, 'init']
            );
        }

    }

    public function init()
    {
        echo require(sprintf('%s/../partials/%s.php', __DIR__, $this->template));
    }

    public function saveSettings()
    {

        $response  = [];
        check_ajax_referer('jsv_save_setting');
        // add default values checkboxes
        foreach ($this->checkBoxes as $checkBox) {
            if (!isset($_POST[$checkBox])) {
                $_POST[$checkBox] = 0;
            }
        }

        $nUpdated  = 0;
        $nExpected = count($_POST) - 2;

        foreach ($_POST as $key => $value) {
            if(in_array($key, ['action','_ajax_nonce'])){
                continue;
            }
            if( !current_user_can('manage_options') ) {
                wp_send_json_error([
                    $key => ['error' => 'user does not have permission to manage options']
                ]);
            }



            $response[$key] = ['value' => '', 'error' => ''];
            if (in_array($key, $this->fields)) {
                $value = _sanitize_text_fields($_POST[$key]);
                $oldValue = get_option($key, '');
                if (update_option($key, $value) || $value === $oldValue) {
                    $nUpdated++;
                    $response[$key]['value'] = $value;
                } else {
                    $response[$key]['error'] = "could not update $key with value $value";
                }
            } else{
                $response[$key]['error'] = "field $key not defined in controller";
            }
        }
        if ($nUpdated === $nExpected) {
            wp_send_json_success($response);
        } else {
            wp_send_json_error($response);
        }
    }

    public function loadHooks()
    {
        add_action('wp_ajax_' . $this::PATH, array($this, 'saveSettings'));
        add_action('wp_ajax_nopriv_' . $this::PATH, array($this, 'saveSettings'));
        foreach ($this->customAjaxHooks as $methodName => $customAjaxHook) {
            add_action('wp_ajax_' . $methodName, array($this, $customAjaxHook));
            add_action('wp_ajax_nopriv_' . $methodName, array($this, $customAjaxHook));
        }
    }

}