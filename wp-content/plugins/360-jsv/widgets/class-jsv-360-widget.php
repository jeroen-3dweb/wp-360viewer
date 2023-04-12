<?php

class JSV_360_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            '360-javasciptviewer-widget',
            __('360 Javascript Viewer', 'text_domain'),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }

    // The widget form (for the backend )
    public function form($instance)
    {
        // Set widget defaults
        $defaults = array(
            'code' => '[360-jsv total-frames=72 speed=90 inertia=30 max-width=200]',
        );

        // Parse current settings with defaults
        extract(wp_parse_args(( array )$instance, $defaults)); ?>

        <?php
        // Widget Title
        ?>
        <p>
            <label for="<?php
            echo esc_attr($this->get_field_id('code')); ?>"><?php
                _e('Shortcode', 'text_domain'); ?>
            </label>
            <input class="widefat" id="<?php
            echo esc_attr($this->get_field_id('code')); ?>" name="<?php
            echo esc_attr($this->get_field_name('code')); ?>"
            value= "<?php echo $instance['code'] ?>"
            />
        </p>

        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance         = $old_instance;
        $instance['code'] = isset($new_instance['code']) ? wp_strip_all_tags($new_instance['code']) : '';
        return $instance;
    }

    public function register()
    {
        register_widget('JSV_360_Widget');
    }

    public function widget($args, $instance)
    {
        if(isset($instance['code'])){
            echo (new JSV_360_Parser('360 jsv', JSV360_VERSION))->parse($instance['code']);
        }
    }
}