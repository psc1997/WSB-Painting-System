<?php
get_header();

    $acf_data = get_fields();

    get_template_part('template-parts/painting/painting-content', null, ['acf_data' => $acf_data]);
    get_template_part('template-parts/painting/painting-others', null, ['acf_data' => $acf_data]);

get_footer();
