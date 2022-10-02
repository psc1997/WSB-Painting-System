<?php
get_header();

    global $wp_query;

    get_template_part('template-parts/search/search-header', null, ['search_text' => $wp_query->query['s'], 'posts_count' => $wp_query->found_posts]);
    get_template_part('template-parts/search/search-content', null, ['posts' => $wp_query->posts]);

get_footer();
