jQuery(function ($) {

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
                sync(
                    {jsv_notifier_image: attachment.id}
                )
            }).open();

    });

    // on remove button click
    $('body').on('click', '.jsv-rmv', function (e) {

        e.preventDefault();
        sync({
            jsv_notifier_image: null
        });
    });

});