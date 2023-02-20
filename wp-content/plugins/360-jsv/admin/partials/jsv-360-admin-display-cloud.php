<?php

include('header.php');
include('jsv-settings-helper.php');
?>

    <div class="jsv-360__home">
        <h1 class="jsv-typography-root jsv-typography-dark jsv-typography-h1">
            <?= __('Use presentations from 3DWeb', 'jsv360') ?>
        </h1>
        <div class="jsv-360__settings">
            <h2>Use presentations by their id</h2>
            <p>
            </p>
            <form method='post' data-source="<?= JSV_360_ADMIN_AUTOROTATE::PATH; ?>">
                <div class="jsv-360__settings__table">
                    <?= jsv_setting_create_row(
                        'API Key',
                        'Enter your API key here',
                        JSV_360_ADMIN_AUTOROTATE::AUTOROTATE,
                        get_option(JSV_360_ADMIN_AUTOROTATE::AUTOROTATE, '')
                    )
                    ?>
                </div>
            </form>
            <?php
            include('button.php'); ?>
        </div>
        <p>cloud hosting</p>

    </div>

<?php
include('footer.php'); ?>