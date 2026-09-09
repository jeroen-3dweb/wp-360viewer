<?php

include('header.php');
include('jsv-settings-helper.php')
?>
    <div class="jsv-360__settings">
        <h1>Advanced: ACF integration</h1>
        <p>Optional: for websites using the Advanced Custom Fields (ACF) plugin. Store a 360° shortcode in a custom field, then select the ACF option in the 360° block or Elementor viewer widget. You do not need ACF to add a view with a regular Shortcode block.
        </p>
        <form method='post' data-source="<?= JSV_360_ADMIN_ACF::PATH; ?>">
            <div class="jsv-360__settings__table">
                <?= jsv_setting_create_row(
                    'ACF field name',
                    'Enter the field name from ACF, for example product_360. Use the field name, not its label or field key. Leave blank if you do not use this integration',
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