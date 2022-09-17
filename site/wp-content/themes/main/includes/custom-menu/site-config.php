<?php

/**
 * Custom Admin Menu dla zarządzania dodatkowymi opcjami strony.
 *
 * @version 1.1.0
 */
if (function_exists('acf_add_options_page')) {
    $general_options_page = acf_add_options_page([
        'page_title'    => 'Opcje strony',
        'menu_title'    => 'Opcje strony',
        'menu_slug'     => 'site-general-settings',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-admin-tools',
        'redirect'      => false,
        'position'      => 100018,
    ]);
}
