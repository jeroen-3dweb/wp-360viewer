<?php

/** @var string $license */

/** @var string $source */


include('header.php');
include('jsv-settings-helper.php');

?>
    <div class="jsv-360__settings">
        <h2>Remove powered by icon</h2>
        <p>To remove the powered by icon when you rotate you need a license. The license is valid forever for the domain
            you choose.
            No limits in usage.  If you use 3dweb.io for your presentations then you don't need a license.<br>
            You can get it <a id="jsv-purchase-link" target="_blank" href="#">here </a>
        </p>

        <form method='post' data-source="<?= JSV_360_ADMIN_LICENSE::PATH; ?>">

            <div class="jsv-360__settings__table">
                <?= jsv_setting_create_row(
                    'License',
                    '',
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