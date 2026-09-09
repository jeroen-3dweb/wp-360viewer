<?php
/** @var string $imageId */

include('header.php');

?>
    <div class="jsv-360__settings">
        <form method='post' data-source="<?= JSV_360_ADMIN_NOTIFIER::PATH; ?>">
            <h1>Drag-to-rotate hint</h1>
            <p>Show visitors that they can drag to rotate the product. Choose a custom hint image to display when the view loads. This image applies to views rendered from shortcodes.</p>

                <div class="jsv-360__settings__settings-holder">
                    <p class="jsv-default-hint">The default drag-to-rotate hint is in use. Choose an image only if you want to replace it, then save your changes.</p>
                    <a href="#" class="jsv-upl">
                        <img alt="Custom drag-to-rotate hint" id="jsv-notifier-thumb" class="jsv-settings__upload-thumb" src=""/>
                    </a>
                    <input type="hidden"
                           name="<?= JSV_360_ADMIN_NOTIFIER::NOTIFIER_IMAGE_ID; ?>"
                           value="<?= get_option(JSV_360_ADMIN_NOTIFIER::NOTIFIER_IMAGE_ID, '') ?>"
                    />

                    <a href="#" class="jsv-upl jsv-upl-link">Choose hint image</a>
                    <a href="#" class="jsv-rmv jsv-rmv-link" style="display:none">Use the default hint</a>
                </div>

        </form>
        <?php
        include('button.php'); ?>

    </div>

    <script type="application/javascript">
        jQuery(function ($) {

            const checkState = () => {
                $('.jsv-default-hint').toggle(!getImageId());
                $('#jsv-notifier-thumb').toggle(Boolean(getImageId()));
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
                    }).catch(() => {
                        $('#jsv-save-settings-status').attr('data-state', 'error').text('Could not load the hint image. Reload this page to try again.');
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
                e.preventDefault();
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
                            text: 'Use this hint image'
                        },
                        multiple: false
                    }).on('select', function () {
                        const selected = custom_uploader.state().get('selection').first();
                        if (!selected) return;
                        const attachment = selected.toJSON();
                        setImageId(attachment.id)
                        getImageSrc(getImageId());
                    }).open();

            });
        });
    </script>

<?php
include('footer.php'); ?>
