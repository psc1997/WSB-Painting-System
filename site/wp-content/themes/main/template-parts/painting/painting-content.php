<?php
    $post = get_post();
    $acf_data = $args['acf_data'];

    $types = wp_get_post_terms($post->ID, 'painting_type');
    $categories = wp_get_post_terms($post->ID, 'painting_category', ['number' => 4]);
    $author_id = $post->post_author;
    $author_name = get_user_meta($author_id, 'nickname', true);
    $author_description = get_user_meta($author_id, 'description', true);
    $author_link = get_author_posts_url($author_id);

    // Sprawdzamy stan ulubionych
    $current_user_id = get_current_user_id();

    if (!empty($current_user_id)) {
        $favourites = get_field('user_favourites', 'user_' . $current_user_id);
    }
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
                <div class="row">
                    <div class="col-12">
                        <?php if (!empty($author_name)) : ?>
                            <h5 class="painting-content__author">
                                <?= esc_html($author_name); ?>
                            </h5>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 text-right">
                        <?php if (!empty($current_user_id)) : ?>
                            <?php if (in_array($post->ID, $favourites, true)) : ?>
                                <button class="button">
                                    <span class="icon icon-heart-full"></span>
                                </button>
                            <?php else : ?>
                                <button class="button button--ghost">
                                    <span class="icon icon-heart-empty"></span>
                                </button>
                            <?php endif; ?>
                        <?php else : ?>
                            <button type="button" class="button button--ghost" data-toggle="tooltip" data-placement="left" title="Zaloguj się, aby dodać obraz do ulubionych!">
                                <span class="icon icon-heart-empty"></span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

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

                <?php if (!empty($author_link)) : ?>
                    <div class="text-right">
                        <a href="<?= esc_url($author_link); ?>" class="button">
                            Skontaktuj się z artystą
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($acf_data['painting_description'])) : ?>
                    <hr class="painting-content__breaker">

                    <h6 class="painting-content__title-text">
                        Opis obrazu:
                    </h6>
                    <p class="painting-content__text">
                        <?= esc_html($acf_data['painting_description']); ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($author_description)) : ?>
                    <hr class="painting-content__breaker">

                    <h6 class="painting-content__title-text">
                        O artyście:
                    </h6>
                    <p class="painting-content__text">
                        <?= esc_html($author_description); ?>
                    </p>

                    <?php if (!empty($author_link)) : ?>
                        <div class="text-right">
                            <a href="<?= esc_url($author_link); ?>" class="button button--ghost">
                                Dowiedz się więcej
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
