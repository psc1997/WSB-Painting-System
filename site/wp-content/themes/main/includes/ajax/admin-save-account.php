<?php
// Exit if accessed directly!
if (!defined('ABSPATH')) {
    exit;
}

// add_action('wp_ajax_nopriv_admin_save_account', 'admin_save_account'); // Wycinamy dla niezalogowanych
add_action('wp_ajax_admin_save_account', 'admin_save_account');

/**
 * Funkcja wysyłająca mail'a z formularza kontaktowego.
 *
 * @return void
 * @version 0.1.0
 */
function admin_save_account()
{
    check_ajax_referer('itr_ajax_nonce', 'security', false) || wp_send_json_error([
        'message' => 'Błąd uwierzytelnena i autoryzacji nonce!<br>Spróbuj odświeżyć stronę!',
    ], 401);

    // =================================
    // = Definiujemy podstawowe zmienne
    // =================================
    $data = (isset($_POST['data'])) ? wp_unslash($_POST)['data'] : null;

    // Zabezpieczamy parametry
    $data = array_map(static function (string $item): string {
        return htmlspecialchars(trim($item));
    }, $data);

    $response = [
        'status' => null,
        'text' => '',
        'errors' => [],
    ];

    // =================================
    // = Walidujemy wprowadzone dane
    // =================================

    // Adres e-mail
    if (strlen($data['public_email']) < 2) {
        $response['errors'][] = 'Adres e-mail musi mieć przynajmniej dwa znaki';
    }
    if (!filter_var($data['public_email'], FILTER_VALIDATE_EMAIL)) {
        $response['errors'][] = 'Wprowadzony adres email jest nieprawidłowy';
    }

    // Wiadomość
    if (isset($data['description']) && 600 < strlen($data['description'])) {
        $response['errors'][] = 'Opis nie może mieć więcej niż 600 znaków';
    }

    // Jeśli były błędy to przestawiamy status na false.
    if (0 < sizeof($response['errors'])) {
        $response['status'] = false;
    }

    // =================================
    // = Zapisujemy dane w panelu
    // =================================
    if ($response['status'] === null) {
        $current_user_id = get_current_user_id();

        update_field('user_public_email', $data['public_email'], 'user_' . $current_user_id);
        update_user_meta($current_user_id, 'description', $data['description']);

        update_user_meta($current_user_id, 'facebook', $data['facebook']);
        update_user_meta($current_user_id, 'instagram', $data['instagram']);
        update_user_meta($current_user_id, 'pinterest', $data['pinterest']);
        update_user_meta($current_user_id, 'tumblr', $data['tumblr']);
        update_user_meta($current_user_id, 'youtube', $data['youtube']);
        update_user_meta($current_user_id, 'wikipedia', $data['wikipedia']);

        wp_send_json_success(json_encode($response));
    }

    wp_send_json_error(json_encode($response));
}
