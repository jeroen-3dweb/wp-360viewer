jQuery(function ($) {

    const sync = function (values) {
        const defaultValues = {
            _ajax_nonce: jsvUpload['security'],
            action: 'jsv_save_settings',
        }
        const fields =
            $.post(jsvUpload['ajaxUrl'], {...defaultValues, ...values}, function (response) {
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

    $('body').on('click', '#jsv-save-settings', function (e) {
        const license = $('#jsv-license').val();
        sync({
            jsv_license: license
        });
    });

    $('body').on('click', '#jsv-purchase-link', function (e) {
        const host = window.location.host;
        const url = `https://store.payproglobal.com/checkout?products[1][id]=17108&page-template=14805&&custom-fields[13117][]=${host}`;
        window.open(url, "_blank") || window.location.replace(url);
    });
});