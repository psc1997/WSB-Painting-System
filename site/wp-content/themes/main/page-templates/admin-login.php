<?php
/* Template Name: Admin: Login */

if (isset($_GET['logout'])) {
    wp_logout();
}

get_header();

    // TODO: Logika IF user jest zalogowany - przekierowanie na panel użytkownika

    // Przekierowanie zalogowanego użytkownika na panel użytkownika
    if (is_user_logged_in()) {
        // wp_safe_redirect();
    }

    get_template_part('template-parts/admin/login/login-content');

get_footer();
