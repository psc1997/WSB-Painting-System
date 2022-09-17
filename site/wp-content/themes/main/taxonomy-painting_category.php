<?php
get_header();

    $type = get_queried_object()->term_id;

    // get_template_part('template-parts/apartments/apartments-filters.php', ['city' => $city]);
    // get_template_part('template-parts/apartments/apartments-items.php', ['city' => $city]);

get_footer();
