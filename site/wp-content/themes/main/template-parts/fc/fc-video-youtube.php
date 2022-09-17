<?php
    // Jeżeli sekcja "FC Video YouTube" wystąpiła, to wrzucamy do GLOBALS flagę o tym informującą, jeżeli jeszcze jej tam nie było.
    if (!isset($GLOBALS['fc_youtube_exists'])) {
        $GLOBALS['fc_youtube_exists'] = true;
    }

    $fc_section = $args['fc_section'];

    $is_wide = !empty($args['is_wide']) ? $args['is_wide'] : false;
    $wrapper_class = ($is_wide === true) ? 'col-24' : 'col-24 col-lg-18 col-xl-16 offset-0 offset-lg-3 offset-xl-4';
?>

<section class="fc-video-youtube">
    <div class="container">
        <div class="row">
            <div class="<?= esc_attr($wrapper_class); ?>">
                <div class="fc-video-youtube__youtube-box">
                    <div class="embed-responsive embed-responsive-16by9">
                        <div class="fc-video-youtube__youtube-cover-box js-youtube-cover-box-start">
                            <button class="fc-video-youtube__youtube-button js-youtube-start-button">
                                <span class="icon icon-video-play fc-video-youtube__youtube-button-icon"></span>
                            </button>
                            <div class="fc-video-youtube__youtube-cover-image-box">
                                <?php if (!empty($fc_section['thumbnail_image_start'])) : ?>
                                    <?= wp_get_attachment_image($fc_section['thumbnail_image_start']['ID'], 'full', null, ['class' => 'fc-video-youtube__youtube-cover-image']); ?>
                                <?php else : ?>
                                    <img src="<?= esc_url(get_template_directory_uri()); ?>/dist/img/thumbnail-youtube.jpg" alt="Thumbnail - Start" class="fc-video-youtube__youtube-cover-image">
                                <?php endif; ?>
                            </div>
                        </div>
                        <iframe type="text/html" width="640" height="360"
                            src="https://www.youtube.com/embed/<?= esc_attr($fc_section['video_id']); ?>?enablejsapi=1"
                            allowfullscreen="allowfullscreen"
                            frameborder="0"
                            id="js-youtube-embed-player-id-<?= esc_attr(uniqid()); ?>"
                            class="embed-responsive-item fc-video-youtube__youtube-player js-youtube-embed-player"></iframe>
                        <div class="fc-video-youtube__youtube-cover-box is-hidden js-youtube-cover-box-end">
                            <button class="fc-video-youtube__youtube-button js-youtube-restart-button">
                                <span class="icon icon-video-replay fc-video-youtube__youtube-button-icon fc-video-youtube__youtube-button-icon--replay"></span>
                            </button>
                            <div class="fc-video-youtube__youtube-cover-image-box">
                                <?php if (!empty($fc_section['thumbnail_image_end'])) : ?>
                                    <?= wp_get_attachment_image($fc_section['thumbnail_image_end']['ID'], 'full', null, ['class' => 'fc-video-youtube__youtube-cover-image']); ?>
                                <?php else : ?>
                                    <img src="<?= esc_url(get_template_directory_uri()); ?>/dist/img/thumbnail-youtube.jpg" alt="Thumbnail - End" class="fc-video-youtube__youtube-cover-image">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
