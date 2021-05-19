jQuery(function ($) {

    const sync = function (endPoint ,values) {
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

    $('body').on('click', '#jsv-save-settings', function (e) {
        e.preventDefault();
        const endPoint = $(this).data('source');
        const data = $(this).parent().find('form').serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
        sync(endPoint,data);
    });
});