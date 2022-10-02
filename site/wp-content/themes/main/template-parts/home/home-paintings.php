<?php
    $paintings_last = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => 10,
    ]);

    $paintings_random = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => 10,
        'orderby' => 'rand',
    ]);
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

    <div class="container">
        <div class="row">
            <div class="col-24">
                <h2 class="home-paintings__title">
                    Artysta miesiąca
                </h2>
                <div class="position-relative mb-5">
                    <div class="swiper home-paintings__slider js-home-artist-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($paintings_random as $key => $painting) : ?>
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
</section>