<?php
// @codingStandardsIgnoreStart

// Wyłączamy admin bar i jego style na froncie
add_filter('show_admin_bar', '__return_false');

// Wyrejestrowujemy niepotrzebne style i skrypty
add_action('wp_enqueue_scripts', function () {
    wp_deregister_style('stylesheet');
    wp_dequeue_style('stylesheet');
    wp_deregister_script('wp-embed');
    wp_dequeue_script('wp-embed');

    // Wyłączamy CSS od Gutenberg Blocks na froncie
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
});

// Czyscimy header
add_action('init', function () {
    add_filter('the_generator', '__return_false');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

    // Wyrzucamy emoji
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
});

// Dodajemy ajax url do zmiennych globalnych w JS
add_action('wp_head', function () {
    echo "<script>\n";
        echo "var pm_theme_url = '" . esc_url(get_template_directory_uri()) . "';";
        echo "var ajax = {\n\turl: " . json_encode(admin_url('admin-ajax.php')) . ",\n";
        echo "\tnonce: " . json_encode(wp_create_nonce('itr_ajax_nonce')) . "\n}\n";
    echo "</script>\n";
});

// Wyłączenie Welcome Panel w adminie
remove_action('welcome_panel', 'wp_welcome_panel');

// Zmiana nazwy z Wpisy na BLOG
add_action('admin_menu', 'pm_change_post_label');
function pm_change_post_label()
{
    global $menu;
    global $submenu;
    $menu[5][0] = 'Blog';
}

// Niestadardowe style w adminie
add_action('wp_before_admin_bar_render', 'pm_admin_custom_styles');
function pm_admin_custom_styles()
{
    echo '
        <style type="text/css">
            #wp-admin-bar-wp-logo {
                display: none!important;
            }
            #adminmenu div.wp-menu-name{
                padding: 8px 8px 8px 0;
            }
            #wp-admin-bar-wpseo-menu, #wp-admin-bar-comments, #wp-admin-bar-new-content {
                display: none;
            }
        </style>
    ';
}

// Zmiana stopki
add_filter('admin_footer_text', 'pm_remove_footer_admin');
function pm_remove_footer_admin()
{
    echo 'Stworzono przez <a href="https://pastamedia.pl" target="_blank">PastaMedia (Patryk Szulc)</a>, korzystając z <a href="http://www.wordpress.org" target="_blank">WordPress</a>.</p>';
}

// Niestandardowe Widgety w Kokpicie
add_action('wp_dashboard_setup', 'pm_custom_dashboard_widgets');
function pm_custom_dashboard_widgets()
{
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_help_widget', 'Informacje', 'pm_custom_dashboard_help');
}
function pm_custom_dashboard_help()
{
    echo '
        <div style="text-align: center; background-color: #232531">
            <img
            src="data:image/png;base64,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"
            alt="PastaMedia"
            style="vertical-align: middle; max-width: 100%" />
        </div>
        <hr>
        <p>Kontakt z deweloperem: <a href="https://pastamedia.pl" target="_blank">pastamedia.pl</a>.</p>
        <p>Prosimy samodzielnie nie aktualizować Wordpressa oraz zainstalowanych wtyczek.</p>
        <div style="padding: 16px; border: 1px solid #8fa3ad; border-radius: 8px; background-color: #ebf5f7; color: #142328;">
            <table style="font-size: 14px;">
                <tr>
                    <td><strong>Wersja Wordpress:</strong></td>
                    <td>'.esc_html(get_bloginfo('version')).'</td>
                </tr>
                <tr>
                    <td><strong>Wersja PHP:</strong></td>
                    <td>'.esc_html(phpversion()).'</td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                    <td><strong>Memory Limit:</strong></td>
                    <td>'.ini_get('memory_limit').'</td>
                </tr>
                <tr>
                    <td><strong>Max Execution Time:</strong></td>
                    <td>'.ini_get('max_execution_time').'</td>
                </tr>
                <tr>
                    <td><strong>Max Upload Filesize:</strong></td>
                    <td>'.ini_get('upload_max_filesize').'</td>
                </tr>
            </table>
        </div>';
}

// Czyscimy kokpit
add_filter('screen_options_show_screen', 'pm_remove_help_tab');
add_filter('get_user_option_screen_layout_dashboard', 'pm_one_column_layout');
add_action('wp_dashboard_setup', 'pm_remove_all_dashboard_meta_boxes', 9999);
add_action('wp_dashboard_setup', function () {
    echo '<style type="text/css">
            #contextual-help-link-wrap { display: none !important; }
        </style>';
});

function pm_remove_help_tab($visible)
{
    global $current_screen;

    if ('dashboard' === $current_screen->base) {
        return false;
    }

    return $visible;
}

function pm_one_column_layout($cols)
{
    if (current_user_can('basic_contributor')) {
        return 1;
    }

    return $cols;
}

function pm_remove_all_dashboard_meta_boxes()
{
    global $wp_meta_boxes;
    $wp_meta_boxes['dashboard']['normal']['core'] = [
        'custom_help_widget' =>  [
            'id' => 'custom_help_widget',
            'title' => 'Informacje',
            'callback' => 'pm_custom_dashboard_help',
            'args' =>
                [
                    '__widget_basename' => 'Informacje',
                ],
            ],
        ];
    $wp_meta_boxes['dashboard']['side']['core'] = [];
}

// Zmiana logotypu i linkowania na stronie logowania
add_action('login_head', 'pm_login_head');
add_filter('login_headerurl', 'pm_login_headerurl');
add_filter('login_headertext', 'pm_login_headertext');

function pm_login_headerurl($url)
{
    return 'https://pastamedia.pl';
}

function pm_login_headertext($url)
{
    return 'Wykonanie strony - PastaMedia';
}

function pm_login_head()
{
    echo '<style type="text/css">
        h1 a {
            background-image: url('. esc_url(get_stylesheet_directory_uri()) . '/dist/img/logo-login-screen.png) !important;
            background-position: center !important;
            background-size: 187px !important;
            width: 187px !important;
        }
    </style>';
}
