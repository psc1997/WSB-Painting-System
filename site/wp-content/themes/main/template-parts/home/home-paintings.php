<?php
    // Ostatnio dodane
    $paintings_last = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => 8,
    ]);

    // Autor miesiąca
    $author = get_field('basic_site_data_month_artist', 'options');
    if (!empty($author)) {
        $paintings_author = get_posts([
            'post_type' => 'painting',
            'posts_per_page' => 8,
            'orderby' => 'rand',
            'author' => $author['ID'],
        ]);
    }
    $author_link = get_author_posts_url($author['ID']);
?>

<section class="home-paintings">
    <?php if (!empty($author) && !empty($paintings_author)) : ?>
        <div class="container">
            <div class="row">
                <div class="col-24">
                    <h2 class="home-paintings__title">
                        Artysta miesiąca - <span><?= esc_html($author['display_name']); ?></span>
                    </h2>
                </div>
            </div>
            <div class="row">
                <?php foreach ($paintings_author as $key => $painting) : ?>
                    <div class="col-6 mb-3">
                        <?php get_template_part('template-parts/item-painting', null, ['painting' => $painting]); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row">
                <div class="col-24">
                    <?php if (!empty($author_link)) : ?>
                        <div class="text-right">
                            <a href="<?= esc_url($author_link); ?>" class="button button--ghost button--big">
                                Zobacz więcej
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-24">
                <h2 class="home-paintings__title">
                    Ostatnio dodane
                </h2>
            </div>
        </div>
        <div class="row">
            <?php foreach ($paintings_last as $key => $painting) : ?>
                <div class="col-6 mb-3">
                    <?php get_template_part('template-parts/item-painting', null, ['painting' => $painting]); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</section>
