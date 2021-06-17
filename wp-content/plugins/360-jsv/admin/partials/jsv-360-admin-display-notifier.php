<?php
/** @var string $imageId */

include('header.php');

?>
    <div class="jsv-360__settings">
        <form method='post' data-source="<?= JSV_360_ADMIN_NOTIFIER::PATH; ?>">
            <h2>Notifier Settings</h2>
            <p>Change the notifier when the presentation is loaded.</p>

                <div class="jsv-360__settings__settings-holder">
                    <a href="#" class="jsv-upl">
                        <img alt="preview" id="jsv-notifier-thumb" class="jsv-settings__upload-thumb" src=""/>
                    </a>
                    <input type="hidden"
                           name="<?= JSV_360_ADMIN_NOTIFIER::NOTIFIER_IMAGE_ID; ?>"
                           value="<?= get_option(JSV_360_ADMIN_NOTIFIER::NOTIFIER_IMAGE_ID, '') ?>"
                    />

                    <a href="#" class="jsv-upl jsv-upl-link">Upload image</a>
                    <a href="#" class="jsv-rmv jsv-rmv-link" style="display:none">Remove image</a>
                </div>

        </form>
        <?php
        include('button.php'); ?>

    </div>

    <script type="application/javascript">
        jQuery(function ($) {

            const checkState = () => {
                if (getImageId()) {
                    $('.jsv-upl-link').hide();
                    $('.jsv-rmv-link').show();
                } else {
                    $('.jsv-upl-link').show();
                    $('.jsv-rmv-link').hide();
                }
            }

            const getImageSrc = (imageId) => {
                window.JSV_ADMIN.sync('get_notifier_image', {<?= JSV_360_ADMIN_NOTIFIER::NOTIFIER_IMAGE_ID; ?>: imageId}, 'get')
                    .then((data) => {
                        if (data.success && data.data.url) {
                            $('#jsv-notifier-thumb').attr('src', data.data.url)
                        } else {
                            $('#jsv-notifier-thumb').attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7')
                        }
                        checkState();
                    })
            }

            const getImageId = () => {
                return $('input[name="<?= JSV_360_ADMIN_NOTIFIER::NOTIFIER_IMAGE_ID; ?>"]').val();
            }

            const setImageId = (imageId) => {
                return $('input[name="<?= JSV_360_ADMIN_NOTIFIER::NOTIFIER_IMAGE_ID; ?>"]').val(imageId);
            }

            $(document).ready(function () {
                getImageSrc(getImageId());
            });

            $('body').on('click', '.jsv-rmv', function (e) {
                setImageId(null);
                getImageSrc(getImageId());
            });

            //
            // // on upload button click
            $('body').on('click', '.jsv-upl', function (e) {

                e.preventDefault();

                const button = $(this),
                    custom_uploader = wp.media({
                        title: 'Insert image',
                        library: {
                            type: 'image'
                        },
                        button: {
                            text: 'Use this image as notifier'
                        },
                        multiple: false
                    }).on('select', function () {
                        const attachment = custom_uploader.state().get('selection').first().toJSON();
                        // button.html('<img class="jsv-notifier-upload-thumb" src="' + attachment.url + '">');

                    }).on('close', function () {
                        const attachment = custom_uploader.state().get('selection').first().toJSON();
                        setImageId(attachment.id)
                        getImageSrc(getImageId());
                    }).open();

            });
        });
    </script>

<?php
include('footer.php'); ?>