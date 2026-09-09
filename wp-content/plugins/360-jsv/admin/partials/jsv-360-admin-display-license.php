<?php

/** @var string $license */

/** @var string $source */


include('header.php');
include('jsv-settings-helper.php');

?>
    <div class="jsv-360__settings">
        <h1>License &amp; branding</h1>
        <p>The free version includes &ldquo;Powered by&rdquo; branding when visitors rotate a product. You can keep using it without a license. To remove this branding, purchase a license for your website domain.<br>
            <a id="jsv-purchase-link" target="_blank" rel="noopener noreferrer" href="#">View license options (opens checkout in a new tab)</a>
        </p>

        <form method='post' data-source="<?= JSV_360_ADMIN_LICENSE::PATH; ?>">

            <div class="jsv-360__settings__table">
                <?= jsv_setting_create_row(
                    'License key',
                    'Already purchased a license? Paste your key here and save your changes',
                    JSV_360_ADMIN_LICENSE::NOTIFIER_LICENSE,
                    get_option(JSV_360_ADMIN_LICENSE::NOTIFIER_LICENSE, ''),
                    'text'
                )
                ?>
            </div>
        </form>
        <?php
        include('button.php'); ?>
    </div>

    <script type="application/javascript">
        jQuery(function ($) {
            $('body').on('click', '#jsv-purchase-link', function (e) {
                const host = window.location.host;
                const url = `https://store.payproglobal.com/checkout?products[1][id]=17108&page-template=14805&&custom-fields[13117][]=${host}`;
                window.open(url, "_blank");
            });
        })
    </script>

<?php
include('footer.php'); ?>