<?php
    $paintings = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => -1,
        'author' => get_current_user_id(),
        'post_status' => 'any',
    ]);
?>

<section class="admin-paintings-content">
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

                    <?php if ($painting->post_status === 'publish') : ?>
                        <button class="button button--ghost mr-1">
                            Ukryj
                        </button>
                    <?php else : ?>
                        <button class="button button--ghost mr-1">
                            Opublikuj
                        </button>
                    <?php endif; ?>

                    <button class="button button--ghost mr-1">
                        Edytuj
                    </button>

                    <button class="button button">
                        <span class="icon icon-trash"></span>
                    </button>
                </div>
            </div>
        </div>
    <?php
        endforeach;
        endif;
    ?>
</section>
