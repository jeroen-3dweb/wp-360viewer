<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class JSV_360_ELEMENTOR_WIDGET extends Widget_Base
{
    const USE_ACF_FIELD = 'use_acf_field';

    const USE_WOO_PRODUCT = 'use_woo_product';

    const USE_DEFAULT = 'use_default';

    public function get_name()
    {
        return '360-javascript-viewer';
    }

    public function get_title()
    {
        return esc_html__('360 Javascript Viewer', JSV360_DOMAIN);
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['360', 'javascript viewer'];
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $code     = $settings['code'];
        $override = $settings['dynamic_shortcode'];

        switch ($override) {
            case self::USE_ACF_FIELD:
                $acfCode = $this->getACFCode();
                $code    = $acfCode ?: $settings['code'];
                break;
            case self::USE_WOO_PRODUCT:
                $wooCommerceCode = $this->getWooCommerceCode();
                $code            = $wooCommerceCode ?: $settings['code'];
                break;
        }

        $output = (new JSV_360_Parser('360 jsv', ''))->parse($code);

        echo $output;
    }

    private function getWooCommerceCode()
    {
        global $product;
        return $product ? get_post_meta($product->get_id(), 'jsv_360_woo_bbcode_', true) : false;
    }

    private function getACFCode()
    {
        $acfFieldName = get_option(JSV_360_ADMIN_ACF::ACF_FIELD, '');
        $post_id      = get_queried_object_id();
        return $post_id ? get_post_meta($post_id, $acfFieldName, true) : false;
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __('Content', JSV360_DOMAIN),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'code',
            array(
                'label'   => __('Enter shortcode', JSV360_DOMAIN),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => __('[360-jsv total-frames=72 main-image-url=https://cdn1.360-javascriptviewer.com/images/blue-shoe-small/20180906-001-blauw.jpg image-url-format=20180906-0xx-blauw.jpg speed=90 inertia=12 zoom=true reverse=true auto-rotate=1 notification-config_drag-to-rotate_show-start-to-rotate-default-notification=true ]',
                    JSV360_DOMAIN),
            )
        );
        $this->add_control(
            'dynamic_shortcode',
            [
                'label' => esc_html__( 'Use Dynamic Shortcode', JSV360_DOMAIN ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'Use code above',
                'options' => [
                    self::USE_DEFAULT => esc_html__( 'Default', 'textdomain' ),
                    self::USE_WOO_PRODUCT => esc_html__( 'Use WooCommerce Shortcode', JSV360_DOMAIN ),
                    self::USE_ACF_FIELD  => esc_html__( 'Use ACF Shortcode', JSV360_DOMAIN ),
                ]
            ]
        );

        $this->end_controls_section();
    }
}