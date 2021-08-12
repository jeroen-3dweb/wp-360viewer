<?php

include('header.php');
include('jsv-settings-helper.php')
?>
    <div class="jsv-360__settings">
        <h2>Autorotate at start</h2>
        <p>When the viewer is loaded you can autorotate your product to get the attention of your visitor.
            This setting adds the autorotate parameter to your presentation. If your code already has an autorotate
            parameter then that one
            will be used.
        </p>
        <form method='post' data-source="<?= JSV_360_ADMIN_AUTOROTATE::PATH; ?>">
            <div class="jsv-360__settings__table">
                <?= jsv_setting_create_row(
                    'Amount of rotations',
                    'Specify how many rotations your product does
                            when the viewer is loaded',
                    JSV_360_ADMIN_AUTOROTATE::AUTOROTATE,
                    get_option(JSV_360_ADMIN_AUTOROTATE::AUTOROTATE, '')
                )
                ?>

                <?= jsv_setting_create_row(
                    'Autorotate speed',
                    'Define the speed for autorotate, if empty it will use the rotation speed of dragging',
                    JSV_360_ADMIN_AUTOROTATE::AUTOROTATE_SPEED,
                    get_option(JSV_360_ADMIN_AUTOROTATE::AUTOROTATE_SPEED, '')
                )
                ?>
            </div>
        </form>
<?php
include('button.php'); ?>
    </div>

<?php
include('footer.php'); ?>