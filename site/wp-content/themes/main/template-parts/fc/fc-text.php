<?php
    $fc_section = $args['fc_section'];

    $is_wide = !empty($args['is_wide']) ? $args['is_wide'] : false;
    $wrapper_class = ($is_wide === true) ? 'col-24' : 'col-24 col-lg-18 col-xl-16 offset-0 offset-lg-3 offset-xl-4';
?>

<section class="fc-text">
    <div class="container">
        <div class="row">
            <div class="<?= esc_attr($wrapper_class); ?>">
                <?php if (!empty($fc_section['text'])) : ?>
                    <div class="fc-text__text-wyswig">
                        <?= wp_kses_post(orphan(make_lightbox($fc_section['text']))); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
