<?php

include('header.php');
include('jsv-settings-helper.php')
?>
    <div class="jsv-360__settings">
        <h2>WooCommerce</h2>
        <p>Settings for WooCommerce.
        </p>
        <form method='post' data-source="<?= JSV_360_ADMIN_WOOCOMMERCE::PATH; ?>">
            <div class="jsv-360__settings__table">
                <?= jsv_setting_create_row(
                    'Add icon to default gallery',
                    'Uncheck this if you don\'t want the icon to be added to the product gallery.',
                    JSV_360_ADMIN_WOOCOMMERCE::ALTER_GALLERY,
                    get_option(JSV_360_ADMIN_WOOCOMMERCE::ALTER_GALLERY, 1),
                    'checkbox'
                )
                ?>
            </div>
        </form>
<?php
include('button.php'); ?>
    </div>

<?php
include('footer.php'); ?>