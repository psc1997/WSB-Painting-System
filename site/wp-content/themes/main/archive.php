<?php
/**
 * Domyślna strona ARCHIVE - teoretycznie nikt nie powinien tutaj trafić, a jeżeli ktokolwiek tu trafi,
 * to serwujemy mu 404, bo trafić tu nie powinien - ma sens? Oczywiście, że ma! ;>
 */
http_response_code(404);

get_header();

    get_template_part('template-parts/e404/e404-header');
    get_template_part('template-parts/e404/e404-see-other');

get_footer();
