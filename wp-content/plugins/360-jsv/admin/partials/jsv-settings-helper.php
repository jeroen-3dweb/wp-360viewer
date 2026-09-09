<?php
function jsv_setting_create_row($label, $description, $name, $value, $type = 'number')
{
    $checked = $type === 'checkbox' && $value ? ' checked' : '';
    $value = $type === 'checkbox' ? 1 : $value;
    return sprintf(
        '<div class="jsv-360__settings__row">
            <label class="jsv-360__settings__label" for="%1$s">%2$s</label>
            <div class="jsv-360__settings-holder">
                <input class="regular-text ltr" id="%1$s" name="%1$s" type="%3$s" value="%4$s"%5$s aria-describedby="%1$s-description">
                <small id="%1$s-description" class="jsv-field-description">%6$s</small>
            </div>
        </div>',
        esc_attr($name), esc_html($label), esc_attr($type), esc_attr($value), $checked, esc_html($description)
    );
}
