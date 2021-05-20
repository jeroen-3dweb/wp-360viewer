<?php

/** @var string $license */

/** @var string $source */


include('header.php');

?>
    <div class="jsv-settings">
        <form method='post' data-source="<?= JSV_360_ADMIN_LICENSE::PATH; ?>">
            <h2>Remove powered by icon</h2>
            <p>To remove the powered by icon when you rotate you need a license. The license is valid forever for the domain you choose.
            No limits in usage.<br> You can get it <a id="jsv-purchase-link" target="_blank" href="#">here </a>
            </p>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="jsv-license">License</label>
                    </th>
                    <td>
                        <div class="jsv-notifier-settings">
                            <div>
                                <input class="regular-text ltr" type="text"
                                       name="<?= JSV_360_ADMIN_LICENSE::NOTIFIER_LICENSE; ?>"
                                       value="<?= get_option(JSV_360_ADMIN_LICENSE::NOTIFIER_LICENSE, '') ?>"/>
                            </div>
                    </td>
                </tr>
            </table>
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