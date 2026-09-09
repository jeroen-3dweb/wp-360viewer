<?php

include('header.php');
include('jsv-settings-helper.php')
?>
    <div class="jsv-360__settings">
        <h1>Automatic rotation</h1>
        <p>Make products turn automatically when a view loads. These are defaults for shortcode views. Rotation settings already included in a shortcode take priority.
        </p>
        <form method='post' data-source="<?= JSV_360_ADMIN_AUTOROTATE::PATH; ?>">
            <div class="jsv-360__settings__table">
                <?= jsv_setting_create_row(
                    'Number of full turns',
                    'For example, enter 1 for one complete turn when the view loads. Enter 0 to turn automatic rotation off',
                    JSV_360_ADMIN_AUTOROTATE::AUTOROTATE,
                    get_option(JSV_360_ADMIN_AUTOROTATE::AUTOROTATE, '')
                )
                ?>

                <?= jsv_setting_create_row(
                    'Automatic rotation speed',
                    'Optional. Leave blank to use the viewer speed. To choose a speed visually, use the online setup tool and copy its shortcode',
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