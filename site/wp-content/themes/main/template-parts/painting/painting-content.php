<?php
    $post = get_post();
    $acf_data = $args['acf_data'];

    $authors = wp_get_post_terms($post->ID, 'painting_author');
    $types = wp_get_post_terms($post->ID, 'painting_type');
    $categories = wp_get_post_terms($post->ID, 'painting_category', ['number' => 4]);
?>

<section class="painting-content">
    <div class="container">
        <div class="row">
            <div class="col-24 col-md-11">
                <div class="painting-content__image-box">
                    <a href="<?= esc_url($acf_data['painting_image']['url']); ?>" data-lightbox="roadtrip">
                        <?= wp_get_attachment_image($acf_data['painting_image']['ID'], 'full', false, ['class' => 'img']); ?>
                    </a>
                </div>
            </div>
            <div class="col-24 col-md-11 offset-0 offset-md-2">
                <?php
                    if (!empty($authors)) :
                    foreach ($authors as $key => $author) :
                ?>
                    <h5 class="painting-content__author">
                        <?= esc_html($author->name); ?>
                    </h5>
                <?php
                    endforeach;
                    endif;
                ?>

                <h1 class="painting-content__title">
                    <?= esc_html($post->post_title); ?>
                </h1>

                <?php if (!empty($acf_data['painting_size']['height'] && !empty($acf_data['painting_size']['width']))) : ?>
                    <p class="painting-content__specification">
                        Rozmiar: <span><?= esc_html($acf_data['painting_size']['height']); ?> x <?= esc_html($acf_data['painting_size']['width']); ?> cm</span>
                    </p>
                <?php endif; ?>

                <?php if (!empty($types)) : ?>
                    <p class="painting-content__specification">
                        Technika:
                        <?php foreach ($types as $key => $type) : ?>
                            <a href="<?= esc_url(get_term_link($type->term_id, 'painting_type')); ?>" target="_blank"><?= esc_html($type->name); ?></a>
                            <?= ($key < sizeof($types) - 1) ? ', ' : ''; ?>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($categories)) : ?>
                    <p class="painting-content__specification">
                        <?= 1 < sizeof($categories) ? 'Kategorie' : 'Kategoria'; ?>:
                        <?php foreach ($categories as $key => $category) : ?>
                            <a href="<?= esc_url(get_term_link($category->term_id, 'painting_category')); ?>" target="_blank"><?= esc_html($category->name); ?></a>
                            <?= ($key < sizeof($categories) - 1) ? ', ' : ''; ?>
                        <?php endforeach; ?>
                    </p>
                <?php endif; ?>

                <div class="text-right">
                    <a href="#" class="button">
                        Skontaktuj się z artystą
                    </a>
                </div>

                <?php if (!empty($acf_data['painting_description'])) : ?>
                    <hr class="painting-content__breaker">

                    <h6 class="painting-content__title-text">
                        Opis obrazu:
                    </h6>
                    <p class="painting-content__text">
                        <?= esc_html($acf_data['painting_description']); ?>
                    </p>
                <?php endif; ?>

                <hr class="painting-content__breaker">

                <h6 class="painting-content__title-text">
                    O artyście:
                </h6>
                <p class="painting-content__text">
                    Curabitur ullamcorper magna non posuere consectetur. Suspendisse sit amet maximus ante. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer eu orci turpis. Vivamus non tristique libero, at sodales justo. Maecenas nec risus at orci vehicula convallis. Phasellus semper, nunc a posuere efficitur, enim augue interdum erat, at suscipit ex nisi at dui.
                </p>
                <div class="text-right">
                    <a href="#" class="button button--ghost">
                        Dowiedz się więcej
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
