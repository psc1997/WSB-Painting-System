<?php
    // Jeżeli sekcja "FC Video CMS" wystąpiła, to wrzucamy do GLOBALS flagę o tym informującą, jeżeli jeszcze jej tam nie było.
    if (!isset($GLOBALS['fc_video_js_exists'])) {
        $GLOBALS['fc_video_js_exists'] = true;
    }

    $fc_section = $args['fc_section'];

    $is_wide = !empty($args['is_wide']) ? $args['is_wide'] : false;
    $wrapper_class = ($is_wide === true) ? 'col-24' : 'col-24 col-lg-18 col-xl-16 offset-0 offset-lg-3 offset-xl-4';
?>

<section class="fc-video-cms">
    <div class="container">
        <div class="row">
            <div class="<?= esc_attr($wrapper_class); ?>">
                <?php
                    switch ($fc_section['video_mode']) :
                    case 'looped':
                ?>
                    <video class="fc-video-cms__player-looped" muted autoplay loop>
                        <source src="<?= esc_url($fc_section['video']['url']); ?>" type="video/mp4">
                        Sorry, your browser doesn't support embedded videos.
                    </video>
                <?php
                        break;
                    case 'default':
                    default:
                ?>
                <div class="embed-responsive embed-responsive-16by9">
                    <video class="embed-responsive-item js-video-player video-js fc-video-cms__player" id="player-rand-<?= esc_attr(uniqid()); ?>" controls>
                    <source src="<?= esc_url($fc_section['video']['url']); ?>" type="video/mp4">
                        Sorry, your browser doesn't support embedded videos.
                    </video>
                </div>
                <?php
                        break;
                    endswitch;
                ?>
            </div>
        </div>
    </div>
</section>
