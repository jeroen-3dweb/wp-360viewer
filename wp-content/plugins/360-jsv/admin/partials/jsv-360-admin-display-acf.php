<?php

include('header.php');
include('jsv-settings-helper.php')
?>
    <div class="jsv-360__settings">
        <h2>Advanced Custom Fields Integration</h2>
        <p>You can add shortcodes to posts, pages or products by using the ACF field.
            The Elementor plugin checks if the field is filled and if so, it will use the shortcode on the page.
        </p>
        <form method='post' data-source="<?= JSV_360_ADMIN_ACF::PATH; ?>">
            <div class="jsv-360__settings__table">
                <?= jsv_setting_create_row(
                    'Name of the ACF field to use',
                    'Specify your ACF field name here.',
                    JSV_360_ADMIN_ACF::ACF_FIELD,
                    get_option(JSV_360_ADMIN_ACF::ACF_FIELD, ''), 'text'
                )
                ?>
            </div>
        </form>
<?php
include('button.php'); ?>
    </div>

<?php
include('footer.php'); ?>