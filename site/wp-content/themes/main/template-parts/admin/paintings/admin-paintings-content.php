<?php
    // Usuwanie obrazu
    if (isset($_GET['remove'])) {
        remove_painting(wp_unslash($_GET['remove']));
    }

    // Dodawanie obrazu
    if (isset($_GET['add_painting'])) {
        add_painting();
    }

    $paintings = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => -1,
        'author' => get_current_user_id(),
        'post_status' => 'any',
    ]);

    $painting_categories = get_terms([
        'painting_category',
    ]);

    $painting_types = get_terms([
        'painting_type',
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

    <!-- Modal - Dodaj nowy obraz -->
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
                                    <input type="number" class="form-control admin-paintings-content__modal-input" name="painting_height" aria-label="Painting height" aria-describedby="painting_height" required>
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
                                    <input type="number" class="form-control admin-paintings-content__modal-input" name="painting_width" aria-label="Painting width" aria-describedby="painting_width" required>
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
                            <select class="form-control js-select2-multiple" name="painting_categories">
                                <?php foreach ($painting_categories as $key => $category) : ?>
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
                            <select class="form-control js-select2" name="painting_type">
                                <?php foreach ($painting_types as $key => $type) : ?>
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
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="painting_file" id="painting_file" aria-describedby="inputGroupFileAddon01" accept="image/jpeg,image/png" capture required>
                                            <label class="custom-file-label" for="painting_file">Wybierz plik</label>
                                        </div>
                                    </div>
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
        if (!empty($paintings)) :
        foreach ($paintings as $key => $painting) :
            $image = get_field('painting_image', $painting->ID);
            $is_sold = get_field('painting_sold', $painting->ID);
    ?>
        <div class="admin-paintings-content__item">
            <div class="row">
                <div class="col-24 col-md-3">
                    <?php if (!empty($image['ID'])) : ?>
                        <?= wp_get_attachment_image($image['ID'], 'thumbnail', false, ['class' => 'img']); ?>
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
                    <?php endif; ?>

                    <?php if ($is_sold === true) : ?>
                        <button class="button button--ghost-green mr-1 js-change-painting" data-id="<?= esc_attr($painting->ID); ?>" data-type="publish">
                            <span class="icon icon-eye"></span><br>
                            Oznacz jako dostępny
                        </button>
                    <?php else : ?>
                        <button class="button button--ghost mr-1 js-change-painting" data-id="<?= esc_attr($painting->ID); ?>" data-type="hide">
                            <span class="icon icon-eye-hide"></span><br>
                            Oznacz jako niedostępny
                        </button>
                    <?php endif; ?>

                    <button class="button button--ghost mr-1">
                        <span class="icon icon-edit"></span><br>
                        Edytuj
                    </button>

                    <a href="?remove=<?= esc_attr($painting->ID); ?>" class="button">
                        <span class="icon icon-trash"></span><br>
                        Usuń
                    </a>
                </div>
            </div>
        </div>
    <?php
        endforeach;
        endif;
    ?>
</section>
