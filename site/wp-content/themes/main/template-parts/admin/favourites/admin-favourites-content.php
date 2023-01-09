<?php
    $current_user_id = get_current_user_id();

    $favourites = get_field('user_favourites', 'user_' . $current_user_id);

    if (!empty($favourites)) {
        $paintings = get_posts([
            'post_type' => 'painting',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'include' => $favourites,
        ]);
    }
?>

<section class="admin-paintings-content">
    <h5 class="admin-paintings-content__title">
        Ulubione obrazy
    </h5>
    <?php
        if (!empty($paintings)) :
        foreach ($paintings as $key => $painting) :
            $image = get_field('painting_image', $painting->ID);
    ?>
        <div class="admin-paintings-content__item">
            <div class="row">
                <div class="col-24 col-md-3">
                    <?php if (!empty($image['ID'])) : ?>
                        <?= wp_get_attachment_image($image['ID'], 'thumbnail', false, ['class' => 'img']); ?>
                    <?php endif; ?>
                </div>
                <div class="col-24 col-md-9 d-flex align-items-center">
                    <p class="admin-paintings-content__item-title">
                        <?= esc_html($painting->post_title); ?>
                    </p>
                </div>
                <div class="col-24 col-md-12 d-flex align-items-center justify-content-end">
                    <a href="<?= esc_url(get_permalink($painting->ID)); ?>" class="button mr-3" target="_blank">
                        Zobacz
                    </a>
                    <button class="button button--square js-change-favourites" data-id="<?= esc_attr($painting->ID); ?>">
                        <span class="icon icon-heart-minus"></span>
                    </button>
                </div>
            </div>
        </div>
    <?php
        endforeach;
        else :
    ?>
        <div class="alert admin__alert admin__alert--error">
            Nie masz jeszcze żadnych ulubionych obrazów.
        </div>
    <?php
        endif;
    ?>
</section>
