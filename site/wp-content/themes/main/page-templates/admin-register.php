<?php
/* Template Name: Admin: Rejestracja */

// Przekierowanie zalogowanego user'a na dashboard
if (is_user_logged_in()) {
    $pages_assignment = get_field('pages_assignment_dashboard', 'option');

    if (!empty($pages_assignment)) {
        wp_safe_redirect($pages_assignment);
        exit();
    }
}

get_header();

    get_template_part('template-parts/admin/register/admin-register-content');

get_footer();
