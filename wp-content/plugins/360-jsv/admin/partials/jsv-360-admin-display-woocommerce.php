<?php

include('header.php');
include('jsv-settings-helper.php')
?>
    <div class="jsv-360__settings">
        <h1>WooCommerce</h1>
        <p>Edit a product and paste your shortcode into the <strong>360 Javascript Viewer Code</strong> box. Add images to the product gallery, update the product and preview it to check the 360° view.
        </p>
        <form method='post' data-source="<?= JSV_360_ADMIN_WOOCOMMERCE::PATH; ?>">
            <div class="jsv-360__settings__table">
                <?= jsv_setting_create_row(
                    'Show the 360° icon in the product gallery',
                    'Adds an entry point to the 360° view in the product gallery. The product needs a viewer shortcode and gallery images. Theme support may vary',
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