<?php
    $fc_section = $args['fc_section'];

    $is_wide = !empty($args['is_wide']) ? $args['is_wide'] : false;
    $wrapper_class = ($is_wide === true) ? 'col-24' : 'col-24 col-lg-18 col-xl-16 offset-0 offset-lg-3 offset-xl-4';

    switch ($fc_section['images_per_row']) {
        case '2':
            $col_class = 'col-24 col-sm-12 col-md-12';
            break;
        case '3':
            $col_class = 'col-24 col-sm-12 col-md-8';
            break;
        case '4':
            $col_class = 'col-24 col-sm-12 col-md-6';
            break;
        default:
            $col_class = 'col-24';
            break;
    }

    $rand_section_id = uniqid();
?>

<section class="fc-gallery-grid">
    <div class="container">
        <div class="row">
            <div class="<?= esc_attr($wrapper_class); ?>">
                <div class="row">
                    <?php
                        if (!empty($fc_section['photos'])) :
                        foreach ($fc_section['photos'] as $key => $photo) :
                    ?>
                        <div class="<?= esc_attr($col_class); ?>">
                            <a href="<?= esc_url($photo['url']); ?>" class="fc-gallery-grid__image-link" data-lightbox="<?= esc_attr($rand_section_id); ?>" data-title="<?= esc_attr($photo['alt']); ?>">
                                <?= wp_get_attachment_image($photo['ID'], 'thumbnail_article', null, ['class' => 'img fc-gallery-grid__image']); ?>
                            </a>
                        </div>
                    <?php
                        endforeach;
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
