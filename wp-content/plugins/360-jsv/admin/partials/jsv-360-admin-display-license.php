<?php

/** @var string $license */
/** @var string $source */


include('header.php');

?>
    <div class="jsv-settings">
        <form method='post'>
            <h2>Viewer Settings</h2>
            <p>These settings applies to all presentations on your site.</p>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="jsv-license">License</label>
                    </th>
                    <td>
                        <div class="jsv-notifier-settings">
                            <div>
                                <input class="regular-text ltr" type="text"  name="<?= JSV_360_ADMIN_LICENSE::NOTIFIER_LICENSE; ?>" value="<?= get_option(JSV_360_ADMIN_LICENSE::NOTIFIER_LICENSE, '') ?>"/>
                            <p class="description">To remove the powered by icon you need to have a licence.<br>
                                You can get it <a id="jsv-purchase-link" target="_blank" href="#">here </a>
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        <button data-source="<?=JSV_360_ADMIN_LICENSE::PATH; ?>" class="jsv-button-base-root jsv-button-root jsv-button-contained jsv-button-contained-primary"
                id="jsv-save-settings">Save
        </button>
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

<?php include('footer.php'); ?>