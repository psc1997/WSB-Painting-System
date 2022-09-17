<?php
    $fc_section = $args['fc_section'];

    $is_wide = !empty($args['is_wide']) ? $args['is_wide'] : false;
    $wrapper_class = ($is_wide === true) ? 'col-24' : 'col-24 col-lg-18 col-xl-16 offset-0 offset-lg-3 offset-xl-4';
?>

<section class="fc-hotspots">
    <div class="container">
        <div class="row">
            <div class="<?= esc_attr($wrapper_class); ?>">
                <div class="row">
                    <div class="col-24">
                        <?php if (!empty($fc_section['hotspots'])) : ?>
                            <div class="fc-hotspots__hotspots">
                                <?php if (!empty($fc_section['hotspots_image']['ID'])) : ?>
                                    <?= wp_get_attachment_image($fc_section['hotspots_image']['ID'], 'full', false, ['class' => 'img fc-hotspots__image js-hotspot-image']); ?>
                                <?php else : ?>
                                    <img src="<?= esc_url(get_template_directory_uri()); ?>/dist/img/thumbnail-image.jpg" class="img fc-hotspots__image js-hotspot-image">
                                <?php endif; ?>
                                <?php foreach ($fc_section['hotspots'] as $key => $hotspot) : ?>
                                    <span class="fc-hotspots__hotspot js-hotspot" style="top: <?= esc_attr($hotspot['coordinate_y']); ?>%; left: <?= esc_attr($hotspot['coordinate_x']); ?>%;"></span>
                                    <div class="fc-hotspots__hotspot-popup js-hotspot-popup" style="top: <?= esc_attr($hotspot['coordinate_y']); ?>%; left: calc(<?= esc_attr($hotspot['coordinate_x']); ?>% + 42px);">
                                        <?php if (!empty($hotspot['title'])) : ?>
                                            <p class="fc-hotspots__hotspot-popup-title <?= (empty($hotspot['text'])) ? 'mb-0' : ''; ?>">
                                                <?= esc_html($hotspot['title']); ?>
                                            </p>
                                        <?php endif; ?>
                                        <?php if (!empty($hotspot['text'])) : ?>
                                            <p class="fc-hotspots__hotspot-popup-text">
                                                <?= esc_wyswig($hotspot['text'], 'lite'); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
