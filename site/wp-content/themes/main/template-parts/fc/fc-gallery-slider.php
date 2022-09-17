<?php
    $fc_section = $args['fc_section'];

    $is_wide = !empty($args['is_wide']) ? $args['is_wide'] : false;
    $wrapper_class = ($is_wide === true) ? 'col-24' : 'col-24 col-lg-18 col-xl-16 offset-0 offset-lg-3 offset-xl-4';

    $rand_section_id = uniqid();
?>

<section class="fc-gallery-slider js-fc-gallery-slider">
    <div class="container">
        <div class="row">
            <div class="<?= esc_attr($wrapper_class); ?> position-relative">
                <button class="fc-gallery-slider__slider-arrow fc-gallery-slider__slider-arrow--prev js-article-slider-prev">
                    <span class="icon icon-arrow-short-right fc-gallery-slider__slider-arrow-icon fc-gallery-slider__slider-arrow-icon--prev"></span>
                </button>
                <div class="fc-gallery-slider__slider js-article-slider" data-images-per-view="<?= esc_attr($fc_section['images_per_view']); ?>">
                    <?php
                        if (!empty($fc_section['photos'])) :
                        foreach ($fc_section['photos'] as $key => $image) :
                    ?>
                        <div class="fc-gallery-slider__slide">
                            <a href="<?= esc_url($image['url']); ?>" class="fc-gallery-slider__slide-image-link" data-lightbox="<?= esc_attr($rand_section_id); ?>" data-title="<?= esc_attr($image['alt']); ?>">
                                <?= wp_get_attachment_image($image['ID'], 'thumbnail_article', null, ['class' => 'img fc-gallery-slider__slide-image']); ?>
                            </a>
                        </div>
                    <?php
                        endforeach;
                        endif;
                    ?>
                </div>
                <button class="fc-gallery-slider__slider-arrow fc-gallery-slider__slider-arrow--next js-article-slider-next">
                    <span class="icon icon-arrow-short-right fc-gallery-slider__slider-arrow-icon fc-gallery-slider__slider-arrow-icon--next"></span>
                </button>
            </div>
        </div>
    </div>
</section>
