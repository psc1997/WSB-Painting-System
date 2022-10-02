<?php
/* Template Name: Admin: Dashboard */

get_header();

?>
<div class="container">
    <div class="row">
        <div class="col-24 col-lg-16">
            <?php get_template_part('template-parts/admin/dashboard/dashboard-content'); ?>
        </div>
        <div class="col-24 col-lg-8">
            <?php get_template_part('template-parts/admin/admin-menu'); ?>
        </div>
    </div>
</div>
<?php
get_footer();
