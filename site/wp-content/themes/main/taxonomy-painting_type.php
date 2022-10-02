<?php
get_header();

    $object = get_queried_object();

    get_template_part('template-parts/paintings/paintings-header', null, ['object' => $object]);
    get_template_part('template-parts/paintings/paintings-content', null, ['object' => $object]);

get_footer();
