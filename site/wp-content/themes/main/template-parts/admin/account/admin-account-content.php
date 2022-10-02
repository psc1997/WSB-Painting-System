<?php
    $current_user_id = get_current_user_id();

    $description = get_user_meta($current_user_id, 'description', true);
    $social_media = [
        'facebook'  => get_user_meta($current_user_id, 'facebook', true),
        'instagram' => get_user_meta($current_user_id, 'instagram', true),
        'pinterest' => get_user_meta($current_user_id, 'pinterest', true),
        'tumblr'    => get_user_meta($current_user_id, 'tumblr', true),
        'youtube'   => get_user_meta($current_user_id, 'youtube', true),
        'wikipedia' => get_user_meta($current_user_id, 'wikipedia', true),
    ];

    $acf_data = get_fields('user_' . $current_user_id);
?>

<section class="admin-account-content">
    <h5 class="admin-account-content__title">
        Podstawowe dane konta
    </h5>
    <div class="row">
        <div class="col-24 col-md-8">
            AVATAR
        </div>
        <div class="col-24 col-md-16">
            <div class="form-group">
                <label for="public_email" class="admin-account-content__label">
                    Publiczny adres e-mail
                </label>
                <input type="mail" class="form-control admin-account-content__input" name="public_email" id="public_email" aria-describedby="public_email_help" placeholder="user@internet.com" value="<?= (!empty($acf_data['user_public_email'])) ? esc_attr($acf_data['user_public_email']) : ''; ?>">
                <small id="public_email_help" class="form-text text-muted">
                    Adres e-mail, który wyświetlany będzie na przycisku "Wyślij wiadomość" widocznym na Twoim profilu
                </small>
            </div>
            <div class="form-group">
                <label for="description" class="admin-account-content__label">
                    Krótki opis autora
                </label>
              <textarea class="form-control admin-account-content__input admin-account-content__input--textarea" name="description" id="description" rows="8"><?= !empty($description) ? esc_html($description) : ''; ?></textarea>
            </div>
        </div>
    </div>

    <hr class="admin-account-content__breaker">

    <h5 class="admin-account-content__title">
        Social media:
    </h5>
    <div class="row">
        <?php foreach ($social_media as $key => $social) : ?>
            <div class="col-24 col-md-12">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                            <span class="icon icon-social-<?= esc_attr($key); ?>"></span>
                        </span>
                    </div>
                    <input type="url" class="form-control admin-account-content__input" placeholder="URL" name="<?= esc_attr($key); ?>" value="<?= (!empty($social)) ? esc_attr($social) : ''; ?>">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
