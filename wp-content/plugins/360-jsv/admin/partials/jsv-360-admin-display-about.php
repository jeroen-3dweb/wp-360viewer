<?php

/** @var string $license */

/** @var string $source */

include('header.php');
include('jsv-settings-helper.php');

?>
    <div class="jsv-360__settings">
        <h2>360 Javascript Viewer</h2>
        <p>
            360 Javascript Viewer is a plugin to show 360 product images in your WordPress site.
            It is a plugin for WordPress and can be used in combination with woocommerce and elementor.
            You can use your own hosted images or use presentations from 3DWeb.io.
        </p>

        <h4>basic</h4>
        <ul>
            <li>Version: <?= JSV360_VERSION?></li>
            <li>License: <?= get_option(JSV_360_ADMIN_LICENSE::NOTIFIER_LICENSE, 'Free version') ?></li>
        </ul>
        <h4>plugins</h4>
        <ul>
            <li>WooCommerce (<?= JSV_360_WOO::woocommerceIsActive() ? 'active' : 'not active'; ?>)</li>
            <li>Elementor (<?= JSV_360_ELEMENTOR::elementorIsActive() ? 'active' : 'not active'; ?>)</li>
        </ul>
    </div>

<?php
include('footer.php'); ?>