<?php
require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');

/**
 * Funkcja dodająca/podmieniająca avatar użytkownika.
 *
 * @param array $image
 * @return void
 * @version 1.0.0
 */
function add_user_avatar(array $image)
{
    $current_user_id = get_current_user_id();
    $errors = [];

    // Weryfikujemy poprawność pliku
    if (!isset($image['type']) || $image['type'] !== 'image/jpeg') {
        $errors[] = 'Nieprawidłowy typ pliku';
    }

    if (!empty($errors)) {
        return $errors;
    }

    if (!empty($current_user_id)) {
        // Jeżeli istnieje avatar, to najpierw usuniemy jego plik i dane
        remove_avatar_file($current_user_id);

        // Dodajemy nowy avatar
        add_avatar_file($image, $current_user_id);
    }
}

/**
 * [...]
 *
 * @param array $image
 * @param integer $user_id
 * @return void
 * @version 1.0.0
 */
function add_avatar_file(array $image, int $user_id)
{
    $current_user = get_user_by('ID', $user_id);

    $path = trailingslashit(wp_upload_dir()['basedir'] . '/avatars/');
    $path_with_file = $path . $user_id . '.jpg';

    if (!is_dir($path)) {
        mkdir($path, 0755);
    }

    $is_uploaded = copy($image['tmp_name'], $path_with_file);

    if ($is_uploaded) {
        // Dodajemy plik do biblioteki WordPress'a
        $attach_id = wp_insert_attachment([
            'guid'           => wp_upload_dir()['url'] . '/' . basename($path_with_file),
            'post_mime_type' => $image['type'],
            'post_title'     => preg_replace('/\.[^.]+$/', '', basename($path_with_file)),
            'post_content'   => 'Avatar dla użytkownika "' . $current_user->user_login . '" (ID: ' . $user_id . ')',
            'post_status'    => 'inherit',
        ], $path_with_file);

        // Aktualizujemy metadane pliku
        $attach_data = wp_generate_attachment_metadata($attach_id, $path_with_file);
        wp_update_attachment_metadata($attach_id, $attach_data);

        // Ustawiamy nowy avatar (ACF)
        if (!empty($attach_id)) {
            update_field('user_avatar', $attach_id, 'user_' . $user_id);
        }
    }
}

/**
 * Funkcja usuwająca aktualny avatar.
 *
 * @param integer $user_id
 * @return void
 */

function remove_avatar_file(int $user_id)
{
    // Sprawdzamy, czy istnieje w bibliotece mediów

    // Sprawdamy, czy jest plik podpięty do user'a
    $user_avatar = get_field('user_avatar', 'user_' . $user_id);

    if (!empty($user_avatar)) {
        $is_deleted = wp_delete_attachment($user_avatar['ID']);

        if ($is_deleted) {
            delete_field('user_avatar', 'user_' . $user_id);
        }
    }
}
