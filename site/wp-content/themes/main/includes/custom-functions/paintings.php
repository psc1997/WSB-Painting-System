<?php

/**
 * [...]
 *
 * @return bool
 * @version 1.0.0
 */
function add_painting(): bool
{
    // wp_verify_nonce('_wpnonce') || wp_send_json_error([
    //     'message' => 'Błąd uwierzytelnena i autoryzacji nonce!<br>Spróbuj odświeżyć stronę!',
    // ], 401);

    $errors = [];

    if (empty($_POST['painting_title'])) {
        $errors[] = 'Dodawany obraz nie posiada tytułu';
    } else {
        if (strlen($_POST['painting_title']) < 3) {
            $errors[] = 'Tytuł obrazu musi być dłuższy niż 3 znaki';
        }
    }

    if (empty($_POST['painting_height'])) {
        $errors[] = 'Brak wysokości obrazu';
    }

    if (empty($_POST['painting_width'])) {
        $errors[] = 'Brak szerokości obrazu';
    }

    if (empty($_FILES['painting_file'])) {
        $errors[] = 'Brak pliku obrazu';
    } else {
        if (!in_array($_FILES['painting_file']['type'], ['image/jpeg', 'image/png'])) {
            $errors[] = 'Nieprawidłowe rozszerzenie pliku';
        }
    }

    // Zwrotka błędów
    if (!empty($errors)) {
        foreach ($errors as $key => $error) {
            show_error($error);
        }
    }

    // Dodawanie nowego obrazu do biblioteki obrazów
    if (empty($errors)) {
        $path = trailingslashit(wp_upload_dir()['path']);
        $extension = substr($_FILES['painting_file']['name'], strrpos($_FILES['painting_file']['name'], '.'));

        $path_with_file = $path . 'painting_' . get_current_user_id() . '_' . time() . $extension;

        $is_uploaded = copy($_FILES['painting_file']['tmp_name'], $path_with_file);

        if ($is_uploaded) {
            // Dodajemy plik do biblioteki WordPress'a
            $attach_id = wp_insert_attachment([
                'guid'           => wp_upload_dir()['url'] . '/' . basename($path_with_file),
                'post_mime_type' => $_FILES['painting_file']['type'],
                'post_title'     => preg_replace('/\.[^.]+$/', '', basename($path_with_file)),
                'post_status'    => 'inherit',
            ], $path_with_file);

            // Aktualizujemy metadane pliku
            if ($attach_data = wp_generate_attachment_metadata($attach_id, $path_with_file)) {
                wp_update_attachment_metadata($attach_id, $attach_data);
            }

            if (!empty($attach_id)) {
                $new_painting_id = wp_insert_post([
                    'post_type' => 'painting',
                    'post_title' => $_POST['painting_title'],
                    'post_status' => 'pending',
                ]);

                if (is_int($new_painting_id)) {
                    update_field('painting_image', $attach_id, $new_painting_id);
                    update_field('painting_size', [
                        'height' => $_POST['painting_height'],
                        'width' => $_POST['painting_width'],
                    ], $new_painting_id);
                    update_field('painting_description', $_POST['painting_description'], $new_painting_id);

                    wp_set_post_terms($new_painting_id, $_POST['painting_categories'], 'painting_category', false);
                    wp_set_post_terms($new_painting_id, $_POST['painting_type'], 'painting_type', false);

                    show_success('Pomyślnie dodano nowy obraz - zobaczysz go na stronie po akceptacji przez administratora');

                    return true;
                }
            }
        }
    }

    return false;
}

/**
 * [...]
 *
 * @return bool
 * @version 1.0.0
 */
function edit_painting(): bool
{
    // wp_verify_nonce('_wpnonce') || wp_send_json_error([
    //     'message' => 'Błąd uwierzytelnena i autoryzacji nonce!<br>Spróbuj odświeżyć stronę!',
    // ], 401);

    $errors = [];

    if (empty($_POST['painting_title'])) {
        $errors[] = 'Dodawany obraz nie posiada tytułu';
    } else {
        if (strlen($_POST['painting_title']) < 3) {
            $errors[] = 'Tytuł obrazu musi być dłuższy niż 3 znaki';
        }
    }

    if (empty($_POST['painting_height'])) {
        $errors[] = 'Brak wysokości obrazu';
    }

    if (empty($_POST['painting_width'])) {
        $errors[] = 'Brak szerokości obrazu';
    }

    // Zwrotka błędów
    if (!empty($errors)) {
        foreach ($errors as $key => $error) {
            show_error($error);
        }
    }

    // Dodawanie nowego obrazu do biblioteki obrazów
    if (empty($errors)) {
        $painting_id = $_POST['painting_id'];

        wp_update_post([
            'ID' => $painting_id,
            'post_title' => $_POST['painting_title'],
        ]);

        update_field('painting_size', [
            'height' => $_POST['painting_height'],
            'width' => $_POST['painting_width'],
        ], $painting_id);
        update_field('painting_description', $_POST['painting_description'], $painting_id);

        wp_set_post_terms($painting_id, $_POST['painting_categories'], 'painting_category', false);
        wp_set_post_terms($painting_id, $_POST['painting_type'], 'painting_type', false);

        show_success('Pomyślnie zmieniono dane obrazu');

        return true;
    }

    return false;
}

/**
 * Funkcja całkowicie usuwająca obraz z bazy.
 *
 * @param integer $painting_id
 * @return bool
 * @version 1.0.0
 */
function remove_painting(int $painting_id): bool
{
    $painting = get_post($painting_id);

    if (!empty($painting) && $painting->post_type === 'painting' && (int)$painting->post_author === get_current_user_id()) {
        $painting_image = get_field('painting_image', $painting->ID);

        $is_deleted = wp_delete_attachment($painting_image['ID']);

        if ($is_deleted) {
            wp_delete_post($painting->ID);

            show_success('Pomyślnie usunięto obraz');

            return true;
        }
    }

    show_error('Nie udało się usunąć obrazu');

    return false;
}
