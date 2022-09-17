<?php
    $fc_section = $args['fc_section'];

    $is_wide = !empty($args['is_wide']) ? $args['is_wide'] : false;
    $wrapper_class = ($is_wide === true) ? 'col-24' : 'col-24 col-lg-18 col-xl-16 offset-0 offset-lg-3 offset-xl-4';

    switch ($fc_section['proportions']) {
        case '8-16':
            $class = [
                'col-24 col-lg-8',
                'col-24 col-lg-16',
            ];
            break;
        case '12-12':
            $class = [
                'col-24 col-lg-12',
                'col-24 col-lg-12',
            ];
            break;
        case '16-8':
            $class = [
                'col-24 col-lg-16',
                'col-24 col-lg-8',
            ];
            break;
        default:
            $class = [
                'col-24 col-lg-12',
                'col-24 col-lg-12',
            ];
            break;
    }
?>

<section class="fc-text-two-cols">
    <div class="container">
        <div class="row">
            <div class="<?= esc_attr($wrapper_class); ?>">
                <div class="row">
                    <div class="<?= esc_attr($class[0]); ?>">
                        <?php if (!empty($fc_section['text_1'])) : ?>
                            <div class="fc-text-two-cols__text_wyswig">
                                <?= wp_kses_post(orphan(make_lightbox($fc_section['text_1']))); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="<?= esc_attr($class[1]); ?>">
                        <?php if (!empty($fc_section['text_2'])) : ?>
                            <div class="fc-text-two-cols__text_wyswig">
                                <?= wp_kses_post(orphan(make_lightbox($fc_section['text_2']))); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
