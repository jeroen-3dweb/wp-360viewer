<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class JSV_360_ELEMENTOR_WIDGET extends Widget_Base
{
    const USE_ACF_FIELD = 'use_acf_field';

    const USE_WOO_PRODUCT = 'use_woo_product';

    const USE_DEFAULT = 'use_default';

    const USE_DWEB = 'use_dweb';

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

    private function addSettingToCustomOverrides($settings, &$customOverrides, $settingName, $customOverridesName)
    {
        $settingValue = $settings[$settingName];
        if ($settingValue === 'yes' || $settingValue == '') {
            $settingValue = $settingValue === 'yes';
        }
        $customOverrides[$customOverridesName] = $settingValue;
        return $customOverrides;
    }

    protected function render()
    {
        $customOverrides = [];
        $settings        = $this->get_settings_for_display();
        $code            = $settings['code'];
        $reference       = $settings['reference'] ?? null;

        $override = $settings['dynamic_shortcode'];

        $mainImageUrl = $settings['main_image_url'] ?? null;
        if ($mainImageUrl && isset($mainImageUrl['url'])) {
            $customOverrides['main-image-url'] = $mainImageUrl['url'];
        }

        // controls
        if ($settings['use_override'] === 'yes') {
            $this->addSettingToCustomOverrides($settings, $customOverrides, 'speed', 'speed');
            $this->addSettingToCustomOverrides($settings, $customOverrides, 'inertia', 'inertia');
            $this->addSettingToCustomOverrides($settings, $customOverrides, 'reverse', 'reverse');
            $this->addSettingToCustomOverrides($settings, $customOverrides, 'stop_at_edges', 'stopAtEdges');

            // auto-rotate
            $this->addSettingToCustomOverrides($settings, $customOverrides, 'auto_rotate', 'autoRotate');
            $this->addSettingToCustomOverrides($settings, $customOverrides, 'auto_rotate_speed', 'autoRotateSpeed');
            $this->addSettingToCustomOverrides($settings, $customOverrides, 'auto_rotate_reverse', 'autoRotateReverse');

            // zoom
            $this->addSettingToCustomOverrides($settings, $customOverrides, 'zoom', 'zoom');
            $this->addSettingToCustomOverrides($settings, $customOverrides, 'zoom_wheel_speed', 'zoomWheelSpeed');
            $this->addSettingToCustomOverrides($settings, $customOverrides, 'zoom_max', 'zoomMax');
        }

        switch ($override) {
            case self::USE_ACF_FIELD:
                $acfCode = $this->getACFCode();
                $code    = $acfCode ?: $settings['code'];
                break;
            case self::USE_WOO_PRODUCT:
                $wooCommerceCode = $this->getWooCommerceCode();
                $code            = $wooCommerceCode ?: $settings['code'];
                break;
            case self::USE_DWEB:
                $code = $this->getCodeForId($settings['dweb_id']);
                break;
        }

        $output = (new JSV_360_Parser('360 jsv', ''))->parse($code, $reference, $customOverrides);

        echo $output;
    }

    private function getCodeForId($id)
    {
        $code = '';
        if ($id) {
            $code = '[360-jsv id="' . $id . '"]';
        }
        return $code;
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
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'source',
            [
                'label' => esc_html__('Main configuration', 'textdomain'),
                'type'  => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dynamic_shortcode',
            [
                'label'       => esc_html__('Use Dynamic Shortcode', JSV360_DOMAIN),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'description' => 'Use this option if you want to use a shortcode from a custom field or a product field',
                'default'     => self::USE_DEFAULT,
                'options'     => [
                    self::USE_DEFAULT     => esc_html__('Use shortcode', JSV360_DOMAIN),
                    self::USE_DWEB        => esc_html__('Use id from 3dweb.io', JSV360_DOMAIN),
                    self::USE_WOO_PRODUCT => esc_html__('Use WooCommerce Shortcode', JSV360_DOMAIN),
                    self::USE_ACF_FIELD   => esc_html__('Use ACF Shortcode', JSV360_DOMAIN),
                ]
            ]
        );
        //wp-admin/admin.php?page=jsv-dedicated-settings
        $url = admin_url('admin.php?page=jsv-dedicated-settings');
        $this->add_control(
            'code',
            array(
                'label'       => __('Enter shortcode', JSV360_DOMAIN),
                'type'        => Controls_Manager::TEXTAREA,
                'description' => sprintf('Generate your code at <a target="_blank" href="%s">360-javascriptviewer.com</a>',
                    $url),
                'default'     => __('',
                    JSV360_DOMAIN),
                'condition'   => [
                    'dynamic_shortcode' => self::USE_DEFAULT,
                ],
                'ai'          =>
                    [
                        'active' => false,
                    ]
            )
        );

        $this->add_control(
            'dweb_id',
            array(
                'label'       => __('Enter ID ', JSV360_DOMAIN),
                'type'        => Controls_Manager::TEXT,
                'description' => 'Enter your id from your presentation created on <a target="_blank" href="https://3dweb.io?utm_source=wordpress&utm_medium=link&utm_campaign=elementor">3DWeb.io</a>',
                'default'     => __('',
                    JSV360_DOMAIN),
                'condition'   => [
                    'dynamic_shortcode' => self::USE_DWEB,
                ],
                'label_block' => true,
                'ai'          =>
                    [
                        'active' => false,
                    ]
            )
        );

        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'api_reference',
            [
                'label'     => esc_html__('API access', 'textdomain'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'reference',
            array(
                'label'       => __('Enter reference', JSV360_DOMAIN),
                'type'        => Controls_Manager::TEXT,
                'description' => 'It can be useful if you need to acces the viewer from your website. Make sure it is unique on a single page. Check for the documentation at <a target="_blank" href="https://www.360-javascriptviewer.com/api?utm_source=wordpress&utm_medium=link&utm_campaign=elementor">API Reference</a>',
                'default'     => __('',
                    JSV360_DOMAIN),
                'ai'          =>
                    [
                        'active' => false,
                    ]
            )
        );

        $this->end_controls_section();


        // override question
        $this->start_controls_section('section_overrides', array(
            'label' => __('Overrides', JSV360_DOMAIN),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ));
        $this->add_control(
            'use_override',
            array(
                'label'       => __('Enable overrides', JSV360_DOMAIN),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'description' => 'Override all settings specified in the main configuration.',
            )
        );

        //  Control options
        $this->add_control(
            'control_heading',
            [
                'label'       => esc_html__('Control', 'textdomain'),
                'description' => 'Control the speed, inertia and direction.',
                'type'        => \Elementor\Controls_Manager::HEADING,
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'speed',
            array(
                'label'     => __('Speed', JSV360_DOMAIN),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'condition' => [
                    'use_override' => 'yes',
                ],
                'default'   => 80,
            )
        );

        $this->add_control(
            'inertia',
            array(
                'label'     => __('Inertia', JSV360_DOMAIN),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'condition' => [
                    'use_override' => 'yes',
                ],
                'default'   => 20,
            )
        );

        $this->add_control(
            'reverse',
            array(
                'label'       => __('Reverse', JSV360_DOMAIN),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'description' => 'Reverse the rotation direction when the user drags the mouse.',
                'condition'   => [
                    'use_override' => 'yes',
                ],
                'default'     => '',
            )
        );

        $this->add_control(
            'stop_at_edges',
            array(
                'label'       => __('Stop at edges', JSV360_DOMAIN),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'description' => 'Blocks repeating images after reaching last image.',
                'condition'   => [
                    'use_override' => 'yes',
                ],
                'default'     => '',
            )
        );

        $this->add_control(
            'autorotate_heading',
            [
                'label'     => esc_html__('Auto Rotate', 'textdomain'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'auto_rotate',
            array(
                'label'       => __('Auto rotate', JSV360_DOMAIN),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'description' => 'Amount of rotations when starting the viewer.',
                'condition'   => [
                    'use_override' => 'yes',
                ],
                'default'     => 0,
            )
        );

        $this->add_control(
            'auto_rotate_speed',
            array(
                'label'       => __('Auto rotate speed', JSV360_DOMAIN),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'description' => 'Speed of autorotate.',
                'condition'   => [
                    'use_override' => 'yes',
                ],
                'default'     => 1,
            )
        );

        $this->add_control(
            'auto_rotate_reverse',
            array(
                'label'       => __('Auto rotate reverse', JSV360_DOMAIN),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'description' => 'Auto rotate the other direction.',
                'condition'   => [
                    'use_override' => 'yes',
                ],
                'default'     => '',
            )
        );

        $this->add_control(
            'zoom_heading',
            [
                'label'     => esc_html__('Zoom', 'textdomain'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'zoom',
            array(
                'label'       => __('Enable zoom', JSV360_DOMAIN),
                'type'        => \Elementor\Controls_Manager::SWITCHER,
                'description' => 'Enable zoom on the viewer.',
                'condition'   => [
                    'use_override' => 'yes',
                ],
                'default'     => '',
            )
        );

        $this->add_control(
            'zoom_wheel_speed',
            array(
                'label'       => __('Zoom wheel speed', JSV360_DOMAIN),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'description' => 'Change the speed of zooming with the mousewheel.',
                'condition'   => [
                    'use_override' => 'yes',
                ],
                'default'     => 50,
            )
        );

        $this->add_control(
            'zoom_max',
            array(
                'label'       => __('Max zoom level', JSV360_DOMAIN),
                'type'        => \Elementor\Controls_Manager::NUMBER,
                'description' => 'If zoom is enabled this is the max zoom factor',
                'condition'   => [
                    'use_override' => 'yes',
                ],
                'default'     => 2,
            )
        );

        $this->end_controls_section();


        //  Design options
        $this->start_controls_section('section_design', array(
            'label' => __('Design', JSV360_DOMAIN),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ));

        $this->add_control(
            'control_design',
            [
                'label'     => esc_html__('Change main image (only with id)', 'textdomain'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        // select image control
        $this->add_control(
            'main_image_url',
            array(
                'label'     => __('Select Image', JSV360_DOMAIN),
                'type'      => \Elementor\Controls_Manager::MEDIA,
                'default'   => array(
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ),
                'condition' => [
                    'dynamic_shortcode' => self::USE_DWEB,
                ],
            )
        );

        $this->end_controls_section();
    }
}