jQuery(function ($) {
    window.JSV_ADMIN = [];
    window.JSV_ADMIN.sync = function (endPoint, values, method) {
        method = method || 'post';
        const defaultValues = {
            _ajax_nonce: jsvUpload['security'],
            action: endPoint,
        }
        return new Promise((resolve, reject) => {
            if(method === 'post') {
                $.post(jsvUpload['ajaxUrl'], {...defaultValues, ...values}, function (response) {
                    if (response['success'] === true) {
                        resolve(response)
                    } else {
                        reject(response)
                    }
                }, "json");
            }
            else{
                $.get(jsvUpload['ajaxUrl'], {...defaultValues, ...values}, function (response) {
                    if (response['success'] === true) {
                        resolve(response)
                    } else {
                        reject(response)
                    }
                }, "json");
            }
        })
    }

    $('body').on('click', '#jsv-save-settings', function (e) {
        e.preventDefault();
        $(e.target).html('saving..')
        const form = $(this).parent().parent().find('form');
        const endPoint = form.data('source');
        const data = form.serializeArray().reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});

        const handleError = (data) => {
            $(e.target).html('error when saving');
            setTimeout(() => {
                $(e.target).html('save');
            }, 2000)

            let errorText = '<ul>';
            $.each(data.data, function (key, val) {
                if (val.error) {
                    errorText += `<li>${val.error}</li>`;
                }
            });
            errorText += '</ul>';
            $(e.target).parent().find('#jsv-save-settings-error').html(errorText);
        }

        const handleSuccess = (data) => {
            $(e.target).html('saved!');
            setTimeout(() => {
                $(e.target).html('save');
            }, 2000)
            $(e.target).parent().find('#jsv-save-settings-error').html('');
        }

        window.JSV_ADMIN.sync(endPoint, data).then((data) => {

            if (data.success) {
                handleSuccess(data);
            } else {
                handleError(data)
            }
        }).catch((error) => {
            handleError(error);
            console.warn(error)
        });
    });
});