/* global ajax, Swal */

/**
 * [...]
 *
 * @version 1.0.0
 */
export default function ajaxChangeFavourites () {
    const $changeButton = $('.js-change-favourites');

    if (0 < $changeButton.length) {
        $changeButton.on('click', function (event) {
            event.preventDefault();

            const paintingId = $(this).attr('data-id');

            $.ajax({
                url: ajax.url,
                type: 'post',
                data: {
                    action: 'change_favourites',
                    security: ajax.nonce,
                    data: {
                        paintingId: paintingId
                    }
                },
                beforeSend: function () {
                    // Type something...
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
