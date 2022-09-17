<?php
/**
 * Funkcja definiująca Custom Post Type dla 'Obrazu'.
 *
 * @version 1.0.0
 */
add_action('init', static function () {
    $labels = [
        'name'                  => 'Obrazy',
        'singular_name'         => 'Obraz',
        'add_new'               => 'Dodaj nowy obraz',
        'add_new_item'          => 'Dodaj nowy obraz',
        'edit_item'             => 'Edytuj obraz',
        'all_items'             => 'Wszystkie obrazy',
        'search_items'          => 'Szukaj obrazu',
        'not_found'             => 'Nie znaleziono żadnego obrazu odpowiadającego podanym kryteriom ;c',
        'not_found_in_trash'    => 'Nie znaleziono żadnego obrazu odpowiadającego podanym kryteriom ;c',
    ];

    $rewrite = [
        'slug'                  => 'obraz',
        'with_front'            => true,
    ];

    $args = [
        'labels'                => $labels,
        'supports'              => ['title'],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 100002,
        'menu_icon'             => 'dashicons-desktop',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        // 'show_in_rest'          => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        // 'rest_base'             => 'painting',
        // 'rest_controller_class' => 'WP_REST_Posts_Controller',
    ];

    register_post_type('painting', $args);
});

/**
 * Funkcja definiująca kategorie dla 'Obraz'.
 *
 * @version 1.0.0
 */
add_action('init', static function () {
    $labels = [
        'name'                  => 'Kategoria',
        'singular_name'         => 'Kategoria',
        'search_items'          => 'Szukaj kategorii',
        'all_items'             => 'Wszystkie kategorie',
        'edit_item'             => 'Edytuj kategorię',
        'update_item'           => 'Aktualizuj kategorię',
        'add_new_item'          => 'Dodaj nową kategorię',
    ];

    $rewrite = [
        'slug'                  => 'kategoria',
        'with_front'            => true,
    ];

    $args = [
        'public' => true,
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => $rewrite,
    ];

    register_taxonomy('painting_category', 'painting', $args);
});

/**
 * Funkcja definiująca technikę malunku dla 'Obraz'.
 *
 * @version 1.0.0
 */
add_action('init', static function () {
    $labels = [
        'name'                  => 'Technika wykonania',
        'singular_name'         => 'Technika wykonania',
        'search_items'          => 'Szukaj techniki wykonania',
        'all_items'             => 'Wszystkie techniki wykonania',
        'edit_item'             => 'Edytuj technikę wykonania',
        'update_item'           => 'Aktualizuj technikę wykonania',
        'add_new_item'          => 'Dodaj nową technikę wykonanai',
    ];

    $rewrite = [
        'slug'                  => 'technika',
        'with_front'            => true,
    ];

    $args = [
        'public' => true,
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => $rewrite,
    ];

    register_taxonomy('painting_type', 'painting', $args);
});

/**
 * Funkcja definiująca autorów dla 'Obraz'.
 *
 * @version 1.0.0
 */
add_action('init', static function () {
    $labels = [
        'name'                  => 'Autor',
        'singular_name'         => 'Autor',
        'search_items'          => 'Szukaj autora',
        'all_items'             => 'Wszyscy autorzy',
        'edit_item'             => 'Edytuj autora',
        'update_item'           => 'Aktualizuj autora',
        'add_new_item'          => 'Dodaj nowego autora',
    ];

    $rewrite = [
        'slug'                  => 'autor',
        'with_front'            => true,
    ];

    $args = [
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => $rewrite,
    ];

    register_taxonomy('painting_author', 'painting', $args);
});

/**
 * Dodanie dodatkowej kolumny do listowania w panelu administratora.
 *
 * @version 1.0.0
 */
add_filter('manage_painting_posts_columns', static function ($columns) {
    $columns = array_merge([
        'painting_thumbnail' => 'Miniaturka',
    ], $columns);

    return $columns;
});

add_action('manage_painting_posts_custom_column', static function ($column, $post_id) {
    switch ($column) {
        case 'painting_thumbnail':
            $temp = get_field('painting_image', $post_id);
            $post_thumbnail = (!empty($temp)) ? $temp['sizes']['thumbnail'] : get_template_directory_uri() . '/dist/img/thumbnail-paintings.jpg';
            echo '<img src="' . esc_url($post_thumbnail) . '" class="admin-panel__painting-thumbnail">';
            break;
    }
}, 10, 2);
