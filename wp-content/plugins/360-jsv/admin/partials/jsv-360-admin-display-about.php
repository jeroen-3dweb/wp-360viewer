<?php

/** @var string $license */

/** @var string $source */

include('header.php');
include('jsv-settings-helper.php');

?>
    <div class="jsv-360__settings">
        <h1>About 360 Javascript Viewer</h1>
        <p>
            Create interactive product views from a sequence of photos. Visitors can drag to see the product from different angles.
            Add views to WordPress pages and posts, or use the WooCommerce and Elementor integrations.
            Photos can be stored in your Media Library or at publicly accessible image URLs.
        </p>

        <h2>Plugin details</h2>
        <ul>
            <li>Version: <?= JSV360_VERSION?></li>
            <li>License: <?= get_option(JSV_360_ADMIN_LICENSE::NOTIFIER_LICENSE, '') ? 'License key saved' : 'Free version with branding' ?></li>
        </ul>
        <h2>Optional integrations</h2>
        <p>You can create a view without these plugins. Their status is shown below.</p>
        <ul>
            <li>WooCommerce (<?= JSV_360_WOO::woocommerceIsActive() ? 'active' : 'not active'; ?>)</li>
            <li>Elementor (<?= JSV_360_ELEMENTOR::elementorIsActive() ? 'active' : 'not active'; ?>)</li>
        </ul>
    </div>

<?php
include('footer.php'); ?>
