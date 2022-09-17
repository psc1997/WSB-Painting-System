<?php
    $fc_section = $args['fc_section'];

    $is_wide = !empty($args['is_wide']) ? $args['is_wide'] : false;
    $wrapper_class = ($is_wide === true) ? 'col-24' : 'col-24 col-lg-18 col-xl-16 offset-0 offset-lg-3 offset-xl-4';
?>

<section class="fc-infobox">
    <div class="container">
        <div class="row">
            <div class="<?= esc_attr($wrapper_class); ?>">
                <div class="fc-infobox__box fc-infobox__box--<?= esc_attr($fc_section['style']); ?>">
                    <div class="fc-infobox__text-wyswig">
                        <?= orphan($fc_section['text']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
