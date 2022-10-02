<?php
/* Template Name: Admin: Zarządzanie obrazami */

if (!is_user_logged_in()) {
    wp_safe_redirect(get_home_url());
    exit();
}

get_header();
?>

<section class="admin">
    <div class="container">
        <div class="row">
            <div class="col-24 col-lg-16">
                <div class="admin__box">
                    <?php get_template_part('template-parts/admin/paintings/admin-paintings-content'); ?>
                </div>
            </div>
            <div class="col-24 col-lg-8">
                <div class="admin__box">
                    <?php get_template_part('template-parts/admin/admin-menu'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
