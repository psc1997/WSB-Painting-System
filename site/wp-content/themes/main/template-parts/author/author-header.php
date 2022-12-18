<?php
    $author = $args['author'];

    $description = get_user_meta($author->ID, 'description', true);
    $social_media = [
        'facebook'  => get_user_meta($author->ID, 'facebook', true),
        'instagram' => get_user_meta($author->ID, 'instagram', true),
        'pinterest' => get_user_meta($author->ID, 'pinterest', true),
        'tumblr'    => get_user_meta($author->ID, 'tumblr', true),
        'youtube'   => get_user_meta($author->ID, 'youtube', true),
        'wikipedia' => get_user_meta($author->ID, 'wikipedia', true),
    ];

    $acf_data = get_fields('user_' . $author->ID);
?>

<section class="author-header">
    <div class="container">
        <div class="row">
            <div class="col-24 col-md-8">
                <div class="author-header__image-box">
                    <?php if (!empty($acf_data['user_avatar'])) : ?>
                        <?= wp_get_attachment_image($acf_data['user_avatar']['ID'], 'thumbnail_painting', false, ['class' => 'img']); ?>
                    <?php else : ?>
                        <img src="<?= esc_url(get_template_directory_uri()); ?>/dist/img/thumbnail-avatar.png" alt="Brak avatara użytkownika" class="img">
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-24 col-md-14 offset-0 offset-md-2">
                <h1 class="author-header__title">
                    <?= esc_html($author->display_name); ?>
                </h1>

                <?php if (!empty($description)) : ?>
                    <hr class="author-header__breaker">

                    <h6 class="author-header__title-text">
                        O artyście:
                    </h6>
                    <p class="author-header__text">
                        <?= esc_html(orphan($description)); ?>
                    </p>
                <?php endif; ?>

                <hr class="author-header__breaker">

                <div class="d-flex">
                    <div>
                        <?php
                            foreach ($social_media as $key => $social) :
                                if (!empty($social)) :
                                ?>
                                    <a href="<?= esc_url($social); ?>" target="_blank" rel="noopener noreferrer" class="button button--<?= esc_attr($key); ?>">
                                        <span class="icon icon-social-<?= esc_attr($key); ?>"></span>
                                    </a>
                                <?php
                                endif;
                            endforeach;
                        ?>
                    </div>

                    <?php if (!empty($acf_data['user_public_email'])) : ?>
                        <a href="mailto:<?= esc_attr(antispambot($acf_data['user_public_email'])); ?>" class="button button--ghost ml-auto">
                            <span class="icon icon-mail mr-2"></span> Napisz wiadomość
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
