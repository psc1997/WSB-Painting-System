<?php
/**
 * Front-page template
 */
get_header();

    get_template_part('template-parts/home/home-welcome');
    get_template_part('template-parts/home/home-categories');
    get_template_part('template-parts/home/home-paintings', null, []);

get_footer();