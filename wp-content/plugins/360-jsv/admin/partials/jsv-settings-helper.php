<?php

function jsv_setting_create_row($label, $description, $name, $value, $type = 'number')
{
    $checked = '';
    if ($type === 'checkbox') {
        $checked = $value ? 'checked' : '';
        $value   = 1;
    }

    return sprintf(
        '
            <div class="jsv-360__settings__row">
                    <div class="jsv-360__settings__label">
                        %s
                    </div>
                    <div class="jsv-360__settings-holder">
                        <input class="regular-text ltr" type="%s"
                               name="%s"
                               %s
                               value="%s"/>
                        <small class="jsv-360-settings__settings-holder__description">%s. </small>
                    </div>
                </div>
      ',
        $label, $type, $name, $checked, $value, $description);
}