/* global ajax, Swal */

/**
 * [...]
 *
 * @version 1.0.0
 */
export default function ajaxChangePainting () {
    const $changeButton = $('.js-change-painting');

    if (0 < $changeButton.length) {
        $changeButton.on('click', function (event) {
            event.preventDefault();

            const paintingId = $(this).attr('data-id'),
                status = $(this).attr('data-type'),
                button = $(this);

            $.ajax({
                url: ajax.url,
                type: 'post',
                data: {
                    action: 'change_painting',
                    security: ajax.nonce,
                    data: {
                        paintingId: paintingId,
                        status: status
                    }
                },
                beforeSend: function () {
                    button.attr('disabled', true);
                },
                success: function (responseRaw) {
                    const response = JSON.parse(responseRaw.data);

                    // Type something...
                    location.reload();
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
