jQuery(function ($) {
    window.JSV_ADMIN = {};
    window.JSV_ADMIN.sync = function (endPoint, values, method) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: jsvUpload.ajaxUrl,
                method: method || 'post',
                dataType: 'json',
                timeout: 20000,
                data: { ...values, _ajax_nonce: jsvUpload.security, action: endPoint }
            }).done(function (response) {
                if (response.success === true) resolve(response);
                else reject(response);
            }).fail(function () {
                reject({ message: 'Could not connect to WordPress. Check your connection and try saving again.' });
            });
        });
    };

    $('body').on('click', '#jsv-save-settings', function (e) {
        e.preventDefault();
        const button = $(this);
        const form = button.closest('.jsv-360__settings').find('form');
        const status = $('#jsv-save-settings-status');
        if (!form.length || button.prop('disabled')) return;
        const data = form.serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
        button.prop('disabled', true).text('Saving…');
        status.attr('data-state', '').text('');
        window.JSV_ADMIN.sync(form.data('source'), data)
            .then(function () {
                status.attr('data-state', 'success').text('Changes saved.');
            })
            .catch(function (error) {
                status.attr('data-state', 'error').text(
                    error && error.message ? error.message : 'Changes could not be saved. Reload this page and try again.'
                );
            })
            .finally(function () {
                button.prop('disabled', false).text('Save changes');
            });
    });
});
