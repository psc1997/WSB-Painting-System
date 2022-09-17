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
        'supports'              => ['title', 'excerpt', 'thumbnail'],
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
        // 'rest_base'             => 'device',
        // 'rest_controller_class' => 'WP_REST_Posts_Controller',
    ];

    register_post_type('painting', $args);
});
