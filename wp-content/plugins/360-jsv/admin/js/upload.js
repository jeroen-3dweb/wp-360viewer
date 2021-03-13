jQuery(function ($) {

    const sync = function (imageId){
        $.post(jsvUpload['ajaxUrl'], {
            _ajax_nonce: jsvUpload['security'],
            action: 'jsv_save_settings',
            jsv_notifier_image: imageId
        }, function (response) {
            if (response['success'] === true) {
                location.reload()
            } else {
                alert('Something wend wrong');
            }
        }, "json");
    }
    // on upload button click
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
                sync(attachment.id)
            })
                .open();

    });

    // on remove button click
    $('body').on('click', '.jsv-rmv', function (e) {

        e.preventDefault();
        sync(null)
    });

});