<?php

/** @var string $license */

/** @var string $source */


include('header.php');

?>
    <div class="jsv-settings">
        <form method='post' data-source="<?= JSV_360_ADMIN_AUTOROTATE::PATH; ?>">
            <h2>Autorotate at start</h2>
            <p>When the viewer is loaded you can autorotate your product to get the attention of your visitor.
            This setting adds the autorotate parameter to your presentation. If your code already has an autorotate parameter then that one
                will be used.
            </p>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="jsv-autorotate">Amount of rotations</label>
                    </th>
                    <td>
                        <div class="jsv-notifier-settings">
                            <div>
                                <input class="regular-text ltr" type="number"
                                       name="<?= JSV_360_ADMIN_AUTOROTATE::AUTOROTATE; ?>"
                                       value="<?= get_option(JSV_360_ADMIN_AUTOROTATE::AUTOROTATE, '') ?>"/>
                            </div>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        include('button.php'); ?>
    </div>


<?php
include('footer.php'); ?>