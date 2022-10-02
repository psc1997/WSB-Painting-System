<?php
get_header();

    $author = get_queried_object();

    get_template_part('template-parts/author/author-header', null, ['author' => $author]);
    get_template_part('template-parts/author/author-content', null, ['author' => $author]);

get_footer();
