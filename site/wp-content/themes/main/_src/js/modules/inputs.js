

/**
 * Init
 *
 * @version 1.0.0
 */
export default function makeInputs () {
    $('.js-select2').select2({
        minimumResultsForSearch: -1,
        placeholder: function () {
            $(this).data('placeholder');
        }
    });

    $('.js-select2-multiple').select2({
        multiple: true,
        placeholder: function () {
            $(this).data('placeholder');
        }
    });

    makeAvatarLogic();
}

/**
 * [...]
 */
function makeAvatarLogic () {
    const $button = $('.js-add-avatar'),
        $fileUpload = $('#js-file-avatar-file'),
        $form = $('.js-upload-avatar-form');

    $button.on('click', (event) => {
        event.preventDefault();

        $fileUpload.trigger('click');
    });

    if (0 < $button.length) {
        $fileUpload.on('input', (event) => {
            event.preventDefault();

            $form.trigger('submit');
        });
    }
}
