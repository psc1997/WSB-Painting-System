<?php
    $painting = $args['painting'];
    $image = get_field('painting_image', $painting->ID);
    $size = get_field('painting_size', $painting->ID);
    $types = wp_get_post_terms($painting->ID, 'painting_type', ['number' => 1]);
    $categories = wp_get_post_terms($painting->ID, 'painting_category', ['number' => 1]);
    $author_id = $painting->post_author;
    $author_name = get_user_meta($author_id, 'nickname', true);

    $open_new_tab = (!empty($args['new_tab'])) ? $args['new_tab'] : false;
?>

<div class="item-painting">
    <a href="<?= esc_url(get_permalink($painting->ID)); ?>" <?= ($open_new_tab) ? 'target="_blank"' : ''; ?> class="card item-painting__card">
        <?php if (!empty($image['ID'])) : ?>
            <?= wp_get_attachment_image($image['ID'], 'thumbnail_painting', false, ['class' => 'img item-painting__card-image']); ?>
        <?php endif; ?>

        <div class="card-body item-painting__card-body">

            <?php if (!empty($painting->post_title)) : ?>
                <h5 class="card-title item-painting__card-title">
                    <?= esc_html($painting->post_title); ?>
                </h5>
            <?php endif; ?>

            <?php if (!empty($author_name)) : ?>
                <h6 class="card-title item-painting__card-author">
                    <?= esc_html($author_name); ?>
                </h6>
            <?php endif; ?>

            <?php if (isset($size) && !empty($size['height'] && !empty($size['width']))) : ?>
                <p class="item-painting__card-specification">
                    <?= esc_html($size['height']); ?> x <?= esc_html($size['width']); ?> cm
                </p>
            <?php endif; ?>

            <?php
                if (!empty($types)) :
                foreach ($types as $key => $type) :
            ?>
                <p class="item-painting__card-specification">
                    <?= esc_html($type->name); ?>
                </p>
            <?php
                endforeach;
                endif;
            ?>
        </div>
        <div class="card-footer">
            <?php
                if (!empty($categories)) :
                foreach ($categories as $key => $category) :
            ?>
                <span class="item-painting__card-tag">
                    <?= esc_html($category->name); ?>
                </span>
            <?php
                endforeach;
                endif;
            ?>
        </div>
    </a>
</div>
