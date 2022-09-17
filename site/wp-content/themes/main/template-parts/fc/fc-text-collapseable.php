<?php
    $fc_section = $args['fc_section'];

    $is_wide = !empty($args['is_wide']) ? $args['is_wide'] : false;
    $wrapper_class = ($is_wide === true) ? 'col-24' : 'col-24 col-lg-18 col-xl-16 offset-0 offset-lg-3 offset-xl-4';

    $uniq_id = uniqid('collapse_');
?>

<section class="fc-text-collapseable">
    <div class="container">
        <div class="row">
            <div class="<?= esc_attr($wrapper_class); ?>">
                <div class="collapse fc-text-collapseable__collapse-content" id="<?= esc_attr($uniq_id); ?>">
                    <?php if (!empty($fc_section['text_wyswig'])) : ?>
                        <div class="fc-text-collapseable__text-wyswig">
                            <?= wp_kses_post(orphan($fc_section['text_wyswig'])); ?>
                        </div>
                    <?php endif; ?>
                    <a href="#<?= esc_attr($uniq_id); ?>" class="fc-text-collapseable__collapse-link" data-toggle="collapse" aria-expanded="false" aria-controls="<?= esc_attr($uniq_id); ?>">
                        <span class="fc-text-collapseable__collapse-link-text fc-text-collapseable__collapse-link-text--show">Pokaż</span>
                        <span class="fc-text-collapseable__collapse-link-text fc-text-collapseable__collapse-link-text--hide">Ukryj</span>
                        całość
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
