<?php
    $paintings_last = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => 10,
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
                    <div class="swiper home-paintings__slider js-home-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($paintings_last as $key => $painting) : ?>
                                <div class="swiper-slide home-paintings__slider-slide">
                                    <?php get_template_part('template-parts/item-painting', null, ['painting' => $painting]); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div
                        class="swiper-button-prev home-paintings__slider-button home-paintings__slider-button--left js-home-slider-button-prev">
                    </div>
                    <div
                        class="swiper-button-next home-paintings__slider-button home-paintings__slider-button--right js-home-slider-button-next">
                    </div>
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
                    <div class="swiper home-paintings__slider js-home-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($paintings_last as $key => $painting) : ?>
                                <div class="swiper-slide home-paintings__slider-slide">
                                    <?php get_template_part('template-parts/item-painting', null, ['painting' => $painting]); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div
                        class="swiper-button-prev home-paintings__slider-button home-paintings__slider-button--left js-home-slider-button-prev">
                    </div>
                    <div
                        class="swiper-button-next home-paintings__slider-button home-paintings__slider-button--right js-home-slider-button-next">
                    </div>
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