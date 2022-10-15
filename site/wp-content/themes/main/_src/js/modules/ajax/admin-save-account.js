/* global ajax, Swal */

/**
 * [...]
 *
 * @version 1.0.0
 */
export default function ajaxSaveAccount () {
    const $form = $('#js-admin-save-account');

    if (0 < $form.length) {
        $form.on('submit', (event) => {
            event.preventDefault();

            const formData = $form.serializeArray().reduce((obj, item) => {
                    obj[item.name] = item.value;

                    return obj;
                }, {}),
                sendButton = $('#js-admin-save-account-button');

            $.ajax({
                url: ajax.url,
                type: 'post',
                data: {
                    action: 'admin_save_account',
                    security: ajax.nonce,
                    data: formData
                },
                beforeSend: function () {
                    sendButton.attr('disabled', 'disabled');

                    sendButton.html('Zapisuję');
                },
                success: function (responseRaw) {
                    const response = JSON.parse(responseRaw.data);

                    sendButton.html('Zapisz zmiany');
                    sendButton.attr('disabled', false);

                    if (responseRaw.success === true) {
                        Swal.fire({
                            type: 'success',
                            title: 'Udało się!',
                            text: 'Dane zostały zapisane'
                        });
                    } else {
                        let errorsList = '';

                        response.errors.forEach((element) => {
                            errorsList += `<li>${element}</li>`;
                        });

                        Swal.fire({
                            type: 'warning',
                            title: 'Uwaga',
                            html: `${'W formularzu wystąpiły następujące błędy:' +
                            '<ul style="text-align: left">'}${errorsList}</ul>`
                        });

                        console.error(response.errors);
                    }
                },
                error: function () {
                    Swal.fire({
                        type: 'error',
                        title: 'Błąd',
                        text: 'Podczas zapisywania wystąpił nieoczekiwany błąd!'
                    });
                }
            });
        });
    }
}
