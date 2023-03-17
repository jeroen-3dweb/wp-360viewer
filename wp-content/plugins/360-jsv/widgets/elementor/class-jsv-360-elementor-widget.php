<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class JSV_360_ELEMENTOR_WIDGET  extends Widget_Base
{
     public function get_name() {
        return '360 Javascript Viewer';
    }

    public function get_title() {
        return esc_html__( '360 Javascript Viewer', JSV360_DOMAIN );
    }

    public function get_icon() {
        return 'eicon-code';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    public function get_keywords() {
        return [ '360', 'javascript viewer' ];
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes( 'code', 'advanced' );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'code' ); ?><?php echo wp_kses( $settings['code'], array() ); ?></div>
        <?php
    }
    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __( 'Content', JSV360_DOMAIN ),
            )
        );
        $this->add_control(
            'code',
            array(
                'label'   => __( 'Enter shortcode', JSV360_DOMAIN),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => __( '[360-jsv total-frames=72 main-image-url=https://cdn1.360-javascriptviewer.com/images/blue-shoe-small/20180906-001-blauw.jpg image-url-format=20180906-0xx-blauw.jpg speed=90 inertia=12 zoom=true reverse=true auto-rotate=1 notification-config_drag-to-rotate_show-start-to-rotate-default-notification=true ]', JSV360_DOMAIN ),
            )
        );
        $this->end_controls_section();
    }

    protected function _content_template() {
        ?>
        <#
        view.addInlineEditingAttributes( 'code', 'none' );
        #>
        <div {{{ view.getRenderAttributeString( 'code' ) }}}>{{{ settings.code }}}</div>
        <?php
    }
}