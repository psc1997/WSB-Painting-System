<?php
    $post = get_post();

    $paintings = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => 10,
        'exclude' => $post->ID,
        'author' => $post->post_author,
    ]);
?>

<?php if (!empty($paintings)) : ?>
    <section class="painting-others">
        <div class="container">
            <div class="row">
                <div class="col-24">
                    <h3 class="painting-others__title">
                        Zobacz pozostałe prace tego artysty!
                    </h3>
                    <div class="position-relative mb-5">
                        <div class="swiper painting-others__slider js-painting-more-slider">
                            <div class="swiper-wrapper">
                                <?php foreach ($paintings as $key => $painting) : ?>
                                    <div class="swiper-slide painting-others__slider-slide">
                                        <?php get_template_part('template-parts/item-painting', null, ['painting' => $painting]); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="swiper-button-prev painting-others__slider-button painting-others__slider-button--prev js-painting-more-slider-button-prev"></div>
                        <div class="swiper-button-next painting-others__slider-button painting-others__slider-button--next js-painting-more-slider-button-next"></div>
                    </div>
                    <div class="text-right">
                        <a href="<?= esc_url(get_author_posts_url($post->post_author)); ?>" class="button button--ghost button--big">
                            Zobacz wszystko
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
