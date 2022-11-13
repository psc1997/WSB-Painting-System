<?php

/**
 * Funkcja przenosząca ważne pozycje w menu administratora na samą górę pod Dashboard.
 *
 * @version 1.0.0
 */
add_filter('custom_menu_order', static function () {
    return true;
});
add_filter('menu_order', static function ($menu_order) {

    global $menu;
    array_push($menu, ['', 'read', 'separator666', '', 'wp-menu-separator']);
    array_push($menu, ['', 'read', 'separator777', '', 'wp-menu-separator']);
    array_push($menu, ['', 'read', 'separator888', '', 'wp-menu-separator']);

    $new_order = [
        'index.php',
        'separator666',
        'edit.php?post_type=painting',
        'site-general-settings',
        'separator777',
        'edit.php?post_type=page',
        'edit.php',
        'upload.php',
        'separator1',
        'edit-comments.php',
        'separator2',
        'nav-menus.php',
        'themes.php',
        'tools.php',
        'plugins.php',
        'users.php',
        'edit.php?post_type=acf-field-group',
        'options-general.php',
        // 'wp-mail-smtp',
        'duplicator',
        'separator888',
    ];

    if (!empty($menu_order)) {
        foreach ($menu_order as $key => $item) {
            if (in_array($item, $new_order, true)) {
                unset($menu_order[$key]);
            }
        }
    }

    if (!empty($menu_order)) {
        $new_order = array_merge($new_order, $menu_order);
    }

    return $new_order;
});

/**
 * Funkcja zwracająca tekst bez sierotek.
 *
 * @param string $text
 * @return string $text - tekst z dodanymi twardymi spacjami (&nbsp;)
 * @version 2.0.0
 */
function orphan(string $text = null): string
{
    if (!empty($text)) {
        if (class_exists('iworks_orphan')) {
            if (empty($GLOBALS['orphan'])) {
                $GLOBALS['orphan'] = new iworks_orphan();
            }
            return $GLOBALS['orphan']->replace($text);
        } else {
            return $text;
        }
    } else {
        return '### - - - ###';
    }
}

/**
 * Funkcja wrapująca grafiki w WYSWIG do Lightbox.
 *
 * @param string $text
 * @return string
 * @version 1.0.0
 */
function make_lightbox(string $text): string
{
    $text = preg_replace("{<img\\s*(.*?)src=('.*?'|\".*?\"|[^\\s]+)(.*?)\\s*/?>}ims", '<a href=$2 data-lightbox="wyswig-lightbox-' . uniqid() . '" class="image-wrapper"><img $1src=$2 $3/></a>', $text);

    return $text;
}

/**
 * Funkcja sprowadzająca rozmiar pliku do ładnej czytelnej jednostki.
 *
 * @param float $bytes
 * @param integer $precision
 *
 * @see https://stackoverflow.com/questions/2510434/format-bytes-to-kilobytes-megabytes-gigabytes
 * @version 1.0.0
 */
function format_bytes(float $bytes, int $precision = 2): string
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
}

/**
 * Funkcja to znormalizowanie wp_kses pod treści WYSWIG.
 *
 * @param string $text - tekst, który ma zostać zabezpieczony
 * @param string $mode - tryb zabezpieczenia (dozwolony pełen WYSWIG lub okrojony WYSWIG)
 * @return string
 * @version 1.0.0
 */
function esc_wyswig(string $text = null, string $mode = 'default'): string
{
    switch ($mode) {
        case 'lite':
            $allowed_html = [
                'a' => [
                    'class' => [],
                    'href'  => [],
                    'rel'   => [],
                    'title' => [],
                ],
                'b' => [],
                'i' => [],
                'li' => [
                    'class' => [],
                ],
                'ol' => [
                    'class' => [],
                ],
                'p' => [
                    'class' => [],
                ],
                'span' => [
                    'id' => [],
                    'class' => [],
                    'title' => [],
                ],
                'strong' => [],
                'br' => [],
                'sup' => [],
                'sub' => [],
            ];
            break;

        default:
            $allowed_html = [
                'a' => [
                    'class' => [],
                    'href'  => [],
                    'rel'   => [],
                    'title' => [],
                ],
                'b' => [],
                'blockquote' => [],
                'code' => [],
                'del' => [
                    'datetime' => [],
                    'title' => [],
                ],
                'dd' => [],
                'dl' => [],
                'dt' => [],
                'em' => [],
                'h1' => [],
                'h2' => [],
                'h3' => [],
                'h4' => [],
                'h5' => [],
                'h6' => [],
                'i' => [],
                'img' => [
                    'alt'    => [],
                    'class'  => [],
                    'height' => [],
                    'src'    => [],
                    'width'  => [],
                ],
                'li' => [
                    'class' => [],
                ],
                'ol' => [
                    'class' => [],
                ],
                'p' => [
                    'class' => [],
                    'style' => [],
                ],
                'span' => [
                    'id' => [],
                    'class' => [],
                    'title' => [],
                    'style' => [],
                ],
                'strike' => [],
                'strong' => [],
                'ul' => [
                    'class' => [],
                ],
                'br' => [],
                'table' => [],
                'thead' => [],
                'tbody' => [],
                'tr' => [],
                'th' => [],
                'td' => [],
            ];
            break;
    }

    $allowed_protocols = [
        'http',
        'https',
        'mailto',
        'tel',
        'fax',
    ];

    return wp_kses($text, $allowed_html, $allowed_protocols);
}

/**
 * Funkcja to znormalizowanie wp_kses pod treści SVG.
 * TODO: Dorobić 'linearGradient', bo chwilowo coś nie działa :/
 *
 * @param string $svg_code - kod SVG, który ma zostać zabezpieczony
 * @return string
 * @version 1.0.0
 */
function esc_svg(string $svg_code): string
{
    $allowed_html = [
        'svg' => [
            'class' => true,
            'aria-hidden' => true,
            'aria-labelledby' => true,
            'role' => true,
            'xmlns' => true,
            'width' => true,
            'height' => true,
            'viewbox' => true, // <= Must be lower case!
        ],
        'g' => [
            'fill' => true,
        ],
        'title' => [
            'title' => true,
        ],
        'path' => [
            'd' => true,
            'fill' => true,
            'stroke' => true,
            'stroke-width' => true,
            'stroke-linecap' => true,
            'stroke-linejoin' => true,
        ],
        'circle' => [
            'cx' => true,
            'cy' => true,
            'r' => true,
            'fill' => true,
        ],
        'polygon' => [
            'points' => true,
            'fill' => true,
        ],
        'defs' => [],
        'linearGradient' => [
            'id' => true,
            'x1' => true,
            'x2' => true,
            'y1' => true,
            'y2' => true,
            'gradientUnits' => true,
        ],
        'stop' => [],
    ];

    return wp_kses($svg_code, $allowed_html, null);
}

/**
 * Undocumented function
 *
 * @param string $message
 * @return void
 */
function show_success(string $message)
{
    echo '<div class="alert admin__alert admin__alert--success">' . esc_html($message) . '</div>';
}

/**
 * Undocumented function
 *
 * @param string $message
 * @return void
 */
function show_error(string $message)
{
    echo '<div class="alert admin__alert admin__alert--error">' . esc_html($message) . '</div>';
}
