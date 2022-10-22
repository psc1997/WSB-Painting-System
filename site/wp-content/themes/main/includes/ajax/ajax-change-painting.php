<?php
// Exit if accessed directly!
if (!defined('ABSPATH')) {
    exit;
}

// add_action('wp_ajax_nopriv_change_painting', 'change_painting'); // Wycinamy dla niezalogowanych
add_action('wp_ajax_change_painting', 'change_painting');

/**
 * Funkcja zmieniająca stan obrazu względem ulubionych.
 * (dodaje lub usuwa obraz z ulubionych)
 *
 * @return void
 * @version 1.0.0
 */
function change_painting()
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

    // ID obrazu
    // if (!isset($data['paintingId']) || $data['paintingId']) {
    //     $response['errors'][] = 'Opis nie może mieć więcej niż 600 znaków';
    // }

    // Jeśli były błędy to przestawiamy status na false.
    if (0 < sizeof($response['errors'])) {
        $response['status'] = false;
    }

    // =================================
    // = Zapisujemy dane w panelu
    // =================================
    if ($response['status'] === null) {
        $painting_id = (int)$data['paintingId'];
        $status = $data['status'];

        switch ($status) {
            case 'publish':
                wp_update_post([
                    'ID' => $painting_id,
                    'post_status' => 'publish',
                ]);
                break;

            case 'hide':
                wp_update_post([
                    'ID' => $painting_id,
                    'post_status' => 'draft',
                ]);
                break;

            default:
                # code...
                break;
        }

        wp_send_json_success(json_encode($response));
    }

    wp_send_json_error(json_encode($response));
}
