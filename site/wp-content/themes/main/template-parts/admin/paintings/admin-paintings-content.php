<?php
    // Usuwanie obrazu
    if (isset($_GET['remove'])) {
        remove_painting(wp_unslash($_GET['remove']));
    }

    // Dodawanie obrazu
    if (isset($_GET['add_painting'])) {
        add_painting();
    }

    // Edycja obrazu
    if (isset($_GET['edit_painting'])) {
        edit_painting();
    }

    $paintings = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => -1,
        'author' => get_current_user_id(),
        'post_status' => 'any',
    ]);

    $painting_categories = get_terms([
        'taxonomy' => 'painting_category',
        'hide_empty' => false,
    ]);

    $painting_types = get_terms([
        'taxonomy' => 'painting_type',
        'hide_empty' => false,
    ]);
?>

<section class="admin-paintings-content">

    <div class="row">
        <div class="col-24 col-md-12">
            <h5 class="admin-paintings-content__title">
                Twoje obrazy
            </h5>
        </div>
        <div class="col-24 col-md-12 text-right">
            <button type="button" class="button" data-toggle="modal" data-target="#add_new_painting">
                Dodaj nowy obraz
            </button>
        </div>
    </div>

    <?php
        // ==========================
        // = DODAWANIE NOWEGO OBRAZU
        // ==========================
    ?>
    <div class="modal fade" id="add_new_painting" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content admin-paintings-content__modal-content">
                <div class="modal-header admin-paintings-content__modal-header">
                    <h5 class="modal-title admin-paintings-content__modal-title">
                        Dodaj nowy obraz
                    </h5>
                    <button type="button" class="close admin-paintings-content__modal-close" data-dismiss="modal" aria-label="Close">
                        <span class="icon icon-close"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="?add_painting" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="painting_title" class="admin-paintings-content__modal-label">
                                Tytuł obrazu
                            </label>
                            <input type="text" class="form-control admin-paintings-content__modal-input" name="painting_title" aria-describedby="helpId" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-24 col-md-12">
                                <label for="painting_height" class="admin-paintings-content__modal-label">
                                    Wysokość obrazu
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control admin-paintings-content__modal-input" name="painting_height" min="0" aria-label="Painting height" aria-describedby="painting_height" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="painting_height">
                                            cm
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-24 col-md-12">
                                <label for="painting_width" class="admin-paintings-content__modal-label">
                                    Szerokość obrazu
                                </label>
                                <div class="input-group">
                                    <input type="number" class="form-control admin-paintings-content__modal-input" name="painting_width" min="0" aria-label="Painting width" aria-describedby="painting_width" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="painting_width">
                                            cm
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="painting_categories" class="admin-paintings-content__modal-label">
                                Kategorie obrazu
                            </label>
                            <select class="form-control js-select2-multiple" name="painting_categories[]" data-placeholder="Wybierz minimum jedną wartość">
                                <?php foreach ($painting_categories as $key => $category) : ?>
                                    <option></option>
                                    <option value="<?= esc_attr($category->term_id); ?>">
                                        <?= esc_html($category->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="painting_categories" class="admin-paintings-content__modal-label">
                                Typ obrazu
                            </label>
                            <select class="form-control js-select2" name="painting_type" data-placeholder="Wybierz jedną wartość">
                                <?php foreach ($painting_types as $key => $type) : ?>
                                    <option></option>
                                    <option value="<?= esc_attr($type->term_id); ?>">
                                        <?= esc_html($type->name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="painting_description" class="admin-paintings-content__modal-label">
                                Opis obrazu <small>- pole opcjonalne</small>
                            </label>
                            <textarea class="form-control admin-paintings-content__modal-input admin-paintings-content__modal-input--textarea" name="painting_description" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-24 col-md-12">
                                    <label for="painting_file" class="admin-paintings-content__modal-label">
                                        Plik obrazu
                                    </label>
                                    <input type="file" name="painting_file" accept="image/jpeg,image/png" capture required>
                                </div>
                                <div class="col-24 col-md-12">
                                    <div class="admin-paintings-content__modal-file-help">
                                        Wymagania pliku:<br>
                                        <ul class="mb-0 pl-4">
                                            <li>
                                                Maksymalny rozmiar pliku: 10 MB
                                            </li>
                                            <li>
                                                Rekomendowana maksymalna długość boku: 2000 px
                                            </li>
                                            <li>
                                                Wymagane rozszerzenie: jpeg, png
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <?php wp_nonce_field(); ?>
                            <button type="submit" class="button">
                                Dodaj obraz
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        // ================================
        // = LISTOWANIE WSZYSTKICH OBRAZÓW
        // ================================
    ?>
    <?php
        if (!empty($paintings)) :
        foreach ($paintings as $key => $painting) :
            $acf_data = get_fields($painting->ID);
            $item_painting_categories = get_the_terms($painting->ID, 'painting_category');
            $item_painting_types = get_the_terms($painting->ID, 'painting_type');

            $item_painting_types = array_map(static function (object $element): int {
                return $element->term_id;
            }, $item_painting_types);

            $item_painting_categories = array_map(static function (object $element): int {
                return $element->term_id;
            }, $item_painting_categories);
    ?>
        <div class="admin-paintings-content__item">
            <div class="row">
                <div class="col-24 col-md-3">
                    <?php if (!empty($acf_data['painting_image']['ID'])) : ?>
                        <a href="<?= esc_url($acf_data['painting_image']['url']); ?>" data-lightbox="painting_<?= esc_attr($acf_data['painting_image']['ID']); ?>">
                            <?= wp_get_attachment_image($acf_data['painting_image']['ID'], 'thumbnail', false, ['class' => 'img']); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-24 col-md-7 d-flex align-items-center">
                    <p class="admin-paintings-content__item-title">
                        <?= esc_html($painting->post_title); ?>
                    </p>
                </div>
                <div class="col-24 col-md-14 d-flex align-items-center justify-content-end">

                    <?php if ($painting->post_status === 'publish') : ?>
                        <a href="<?= esc_url(get_permalink($painting->ID)); ?>" class="button mr-1" target="_blank">
                            <span class="icon icon-link"></span><br>
                            Zobacz
                        </a>

                        <?php if ($acf_data['painting_sold'] === true) : ?>
                            <button class="button button--ghost-grey mr-1 js-change-painting" data-id="<?= esc_attr($painting->ID); ?>" data-type="publish">
                                <span class="icon icon-eye-hide"></span><br>
                                Niedostępny
                            </button>
                        <?php else : ?>
                            <button class="button button--ghost mr-1 js-change-painting" data-id="<?= esc_attr($painting->ID); ?>" data-type="hide">
                                <span class="icon icon-eye"></span><br>
                                Dostępny
                            </button>
                        <?php endif; ?>
                    <?php endif; ?>

                    <button type="button" class="button button--ghost mr-1" data-toggle="modal" data-target="#edit_painting_<?= esc_attr($key); ?>">
                        <span class="icon icon-edit"></span><br>
                        Edytuj
                    </button>

                    <a href="?remove=<?= esc_attr($painting->ID); ?>" class="button">
                        <span class="icon icon-trash"></span><br>
                        Usuń
                    </a>
                </div>
            </div>
            <?php if ($painting->post_status !== 'publish') : ?>
                <div class="alert admin__alert admin__alert--error mt-2 mb-0">
                    Ten obraz oczekuje na zaakceptowanie przez administratora. Nie jest on jeszcze widoczny na stronie.
                </div>
            <?php endif; ?>
        </div>

        <?php
            // ======================
            // = EDYCJA OBRAZU
            // ======================
        ?>
        <div class="modal fade" id="edit_painting_<?= esc_attr($key); ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content admin-paintings-content__modal-content">
                    <div class="modal-header admin-paintings-content__modal-header">
                        <h5 class="modal-title admin-paintings-content__modal-title">
                            Edycja obrazu
                        </h5>
                        <button type="button" class="close admin-paintings-content__modal-close" data-dismiss="modal" aria-label="Close">
                            <span class="icon icon-close"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="?edit_painting" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="painting_title" class="admin-paintings-content__modal-label">
                                    Tytuł obrazu
                                </label>
                                <input type="text" class="form-control admin-paintings-content__modal-input" name="painting_title" aria-describedby="helpId" value="<?= esc_attr($painting->post_title); ?>" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-24 col-md-12">
                                    <label for="painting_height" class="admin-paintings-content__modal-label">
                                        Wysokość obrazu
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control admin-paintings-content__modal-input" name="painting_height" min="0" aria-label="Painting height" aria-describedby="painting_height" value="<?= esc_attr($acf_data['painting_size']['height']); ?>" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="painting_height">
                                                cm
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-24 col-md-12">
                                    <label for="painting_width" class="admin-paintings-content__modal-label">
                                        Szerokość obrazu
                                    </label>
                                    <div class="input-group">
                                        <input type="number" class="form-control admin-paintings-content__modal-input" name="painting_width" min="0" aria-label="Painting width" aria-describedby="painting_width" value="<?= esc_attr($acf_data['painting_size']['width']); ?>" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="painting_width">
                                                cm
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="painting_categories" class="admin-paintings-content__modal-label">
                                    Kategorie obrazu
                                </label>
                                <?php var_dump($item_painting_categories); ?>
                                <select class="form-control js-select2-multiple" name="painting_categories[]" data-placeholder="Wybierz minimum jedną wartość">
                                    <?php foreach ($painting_categories as $key => $category) : ?>
                                        <option value="<?= esc_attr($category->term_id); ?>" <?= (in_array($category->term_id, $item_painting_categories)) ? 'selected' : ''; ?>>
                                            <?= esc_html($category->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="painting_categories" class="admin-paintings-content__modal-label">
                                    Typ obrazu
                                </label>
                                <select class="form-control js-select2" name="painting_type" data-placeholder="Wybierz jedną wartość">
                                    <?php foreach ($painting_types as $key => $type) : ?>
                                        <option value="<?= esc_attr($type->term_id); ?>" <?= (in_array($type->term_id, $item_painting_types)) ? 'selected' : ''; ?>>
                                            <?= esc_html($type->name); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="painting_description" class="admin-paintings-content__modal-label">
                                    Opis obrazu <small>- pole opcjonalne</small>
                                </label>
                                <textarea class="form-control admin-paintings-content__modal-input admin-paintings-content__modal-input--textarea" name="painting_description" rows="5"><?= esc_html($acf_data['painting_description']); ?></textarea>
                            </div>
                            <div class="text-right">
                                <?php wp_nonce_field(); ?>
                                <input type="hidden" name="painting_id" value="<?= esc_attr($painting->ID); ?>">
                                <button type="submit" class="button">
                                    Zapisz obraz
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
        endforeach;
        endif;
    ?>
</section>
