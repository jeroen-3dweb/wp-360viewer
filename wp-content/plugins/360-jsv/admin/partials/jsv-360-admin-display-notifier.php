<?php

include('header.php');

?>
<div class="jsv-settings">
    <form method='post'>
        <h2>Viewer Settings</h2>
        <p>These settings applies to all presentations on your site.</p>
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="notifierImage">Notifier image</label>
                </th>
                <td>
                    <div class="jsv-notifier-settings">
                        <?php
                        /** @var int $image_id */
                        if( $image = wp_get_attachment_image_src($image_id ) ) {
                        echo '<a href="#" class="jsv-upl"><img class="jsv-notifier-upload-thumb" src="' . $image[0] . '" /></a>
                        <a href="#" class="jsv-rmv">Remove image</a>
                        <input type="hidden" name="jsv-notifier-img" value="' . $image_id . '"/>';

                        } else {
                        echo '<a href="#" class="jsv-upl">Upload image</a>
                        <a href="#" class="jsv-rmv" style="display:none">Remove image</a>
                        <input type="hidden" name="jsv-notifier-img" value="">';
                        } ?>
                    </div>
                </td>
            </tr>
<!--            <tr>-->
<!--                <th scope="row">-->
<!--                    <label for="jsv-license">License</label>-->
<!--                </th>-->
<!--                <td>-->
<!--                    <div class="jsv-notifier-settings">-->
<!--                        --><?php // include 'jsv-360-admin-display-license.php' ?>
<!--                        <p class="description">To remove the powered by icon you need to have a licence.-->
<!--                            You can get it <a id="jsv-purchase-link" target="_blank" href="#">here </a>-->
<!--                        </p>-->
<!--                    </div>-->
<!--                </td>-->
<!--            </tr>-->
        </table>


        <div class="jsv-notifier-settings">

        </div>
    </form>
    <button class="jsv-button-base-root jsv-button-root jsv-button-contained jsv-button-contained-primary"
            id="jsv-save-settings">Save
    </button>


</div>


<?php include('footer.php'); ?>