<?php
    $fc_section = $args['fc_section'];

    $is_wide = !empty($args['is_wide']) ? $args['is_wide'] : false;
    $wrapper_class = ($is_wide === true) ? 'col-24' : 'col-24 col-lg-18 col-xl-16 offset-0 offset-lg-3 offset-xl-4';
?>

<section class="fc-image-comparison">
    <div class="container">
        <div class="row">
            <div class="<?= esc_attr($wrapper_class); ?>">
                <div class="row">
                    <div class="col-24">
                        <div class="fc-image-comparison__juxtapose juxtapose" data-showcredits="false">
                            <?= wp_get_attachment_image($fc_section['image_comparation_images']['image_1']['ID'], 'full', null, ['data-label' => $fc_section['image_comparation_images']['image_1_title']]); ?>
                            <?= wp_get_attachment_image($fc_section['image_comparation_images']['image_2']['ID'], 'full', null, ['data-label' => $fc_section['image_comparation_images']['image_2_title']]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div
    </div>
</section>
