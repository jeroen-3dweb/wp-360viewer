<?php
function jsv_setting_create_row($label, $description, $name, $value, $type= 'number'){
    return sprintf(
        '
            <div class="jsv-settings__row">
                    <div class="jsv-settings__label">
                        %s
                    </div>
                    <div class="jsv-settings__settings-holder">
                        <input class="regular-text ltr" type="%s"
                               name="%s"
                               value="%s"/>
                        <p class="jsv-settings__settings-holder__description">%s. </p>
                    </div>
                </div>
      ',
        $label,$type, $name, $value, $description);
}