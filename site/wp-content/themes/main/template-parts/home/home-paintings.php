<?php
    // Ostatnio dodane
    $paintings_last = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => 10,
    ]);

    // Autor miesiąca
    $author = get_field('basic_site_data_month_artist', 'options');
    if (!empty($author)) {
        $paintings_author = get_posts([
            'post_type' => 'painting',
            'posts_per_page' => 10,
            'orderby' => 'rand',
            'author' => $author['ID'],
        ]);
    }
?>

<section class="home-paintings">
    <div class="container mb-5">
        <div class="row">
            <div class="col-24">
                <h2 class="home-paintings__title">
                    Ostatnio dodane
                </h2>
                <div class="position-relative mb-5">
                    <div class="swiper home-paintings__slider js-home-last-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($paintings_last as $key => $painting) : ?>
                                <div class="swiper-slide home-paintings__slider-slide">
                                    <?php get_template_part('template-parts/item-painting', null, ['painting' => $painting]); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="swiper-button-prev home-paintings__slider-button home-paintings__slider-button--prev js-home-last-slider-button-prev"></div>
                    <div class="swiper-button-next home-paintings__slider-button home-paintings__slider-button--next js-home-last-slider-button-next"></div>
                </div>
                <div class="text-right">
                    <a href="#" class="button button--ghost button--big">
                        Zobacz więcej
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php if (!empty($author) && !empty($paintings_author)) : ?>
        <div class="container">
            <div class="row">
                <div class="col-24">
                    <h2 class="home-paintings__title">
                        Artysta miesiąca - <span><?= esc_html($author['display_name']); ?></span>
                    </h2>
                    <div class="position-relative mb-5">
                        <div class="swiper home-paintings__slider js-home-artist-slider">
                            <div class="swiper-wrapper">
                                <?php foreach ($paintings_author as $key => $painting) : ?>
                                    <div class="swiper-slide home-paintings__slider-slide">
                                        <?php get_template_part('template-parts/item-painting', null, ['painting' => $painting]); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="swiper-button-prev home-paintings__slider-button home-paintings__slider-button--prev js-home-artist-slider-button-prev"></div>
                        <div class="swiper-button-next home-paintings__slider-button home-paintings__slider-button--next js-home-artist-slider-button-next"></div>
                    </div>
                    <div class="text-right">
                        <a href="#" class="button button--ghost button--big">
                            Zobacz więcej
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</section>