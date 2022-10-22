

/**
 * Init
 *
 * @version 1.0.0
 */
export default function makeInputs () {
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
