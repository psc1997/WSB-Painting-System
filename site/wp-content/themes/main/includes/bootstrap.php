<?php
// @codingStandardsIgnoreStart

/**
 * PastaMedia setup
 *
 * „Mniej to więcej” Ludwig Mies van der Rohe
 *
 * P.S. NIE DOTYKAJ MNIE
 */

defined('ABSPATH') || exit();

defined('INCLUDES') ||
    define('INCLUDES', dirname(__FILE__) . DIRECTORY_SEPARATOR);

// Composer vendors
if (file_exists(dirname(ABSPATH) . DIRECTORY_SEPARATOR . 'vendor/autoload.php')) {
    require_once dirname(ABSPATH) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
}

final class PastaMedia
{
    /**
     * PastaMedia version.
     *
     * @var string
     */
    public $version = '2.0.0';

    /**
     * @var PastaMedia
     */
    protected static $_instance = null;

    /**
     * Przechowuje zmienne szablonu
     *
     * @var array
     */
    private $config;
    private $defaults = [
        'disable_default_search' => false,
        'enable_post_thumbnails' => true,
        'img_dir' => '/dist/img',
        'image_sizes' => [],
        'menus' => [],
    ];

    // file_get_contents ssl fix
    private $stream_opts = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ];

    /**
     * Adres URI szablonu
     *
     * @var string
     */
    public $template_uri;

    /**
     * Zwraca singleton
     *
     * @return PastaMedia
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct()
    {
        // Ustawienia
        $load_config = require_once INCLUDES . 'config.php';
        $this->config = array_merge($this->defaults, $load_config);

        // Ładujemy dodatkowe moduły
        $this->load_dependencies();

        // Inicjalizacja
        add_action('init', [$this, 'init']);

        // Ładujemy assety
        add_action('wp_enqueue_scripts', [$this, 'load_assets']);
        add_action('admin_enqueue_scripts', [$this, 'load_admin_assets']);

        // Wyłączamy domyślną wyszukiwarkę
        if ($this->config['disable_default_search']) {
            add_action('parse_query', [$this, 'disable_default_search']);
            add_filter('get_search_form', function ($a) {
                return null;
            });
        }
    }

    /**
     * Hook do inicjalizacji Wordpressa
     *
     * @return void
     */
    public function init()
    {
        // URL do folderu templatki
        $this->template_uri = get_template_directory_uri();

        // Rejestrujemy dodatkowe menu
        $this->register_menus();

        // Dodatkowe rozmiary obrazków
        $this->register_images();

        // Włączamy support dla HTML5
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ]);
    }

    /**
     * Plik bootstrapujący zależności szablonu
     *
     * @return void
     */
    public function load_dependencies()
    {
        require_once INCLUDES . 'require.php';
    }

    /**
     * Ładujemy pliki JS i CSS
     *
     * @return void
     */
    public function load_assets()
    {
        // Przerzucamy jQuery do stopki
        wp_deregister_script('jquery');
        wp_register_script(
            'jquery',
            includes_url('/js/jquery/jquery.min.js'),
            false,
            null,
            true
        );
        wp_enqueue_script('jquery');

        // Rejestrujemy skrypty - unikamy zewnętrznych bibliotek, staramy się wszystko skompilować gulpem do pojedynczego pliku
        $manifest_js = TEMPLATEPATH . '/dist/js/rev-manifest.json';
        if (file_exists($manifest_js)) {
            $main_scripts = (array) json_decode(
                file_get_contents(
                    $manifest_js,
                    false,
                    stream_context_create($this->stream_opts)
                ),
                true
            );
            $main_scripts = $main_scripts['main.js'];
        } else {
            $main_scripts = 'main.js';
        }
        wp_register_script(
            'main_scripts',
            $this->template_uri . '/dist/js/' . $main_scripts,
            ['jquery'],
            null,
            true
        );
        wp_enqueue_script('main_scripts');

        // Rejestrujemy style - unikamy zewnętrznych bibliotek, staramy się wszystko skompilować gulpem do pojedynczego pliku
        $manifest_css = TEMPLATEPATH . '/dist/css/rev-manifest.json';
        if (file_exists($manifest_css)) {
            $main_style = (array) json_decode(
                file_get_contents(
                    $manifest_css,
                    false,
                    stream_context_create($this->stream_opts)
                ),
                true
            );
            $main_style = $main_style['main.css'];
        } else {
            $main_style = 'main.css';
        }
        wp_register_style(
            'main_style',
            $this->template_uri . '/dist/css/' . $main_style,
            [],
            null
        );
        wp_enqueue_style('main_style');
    }

    /**
     * Ładujemy pliki JS i CSS w zapleczu
     *
     * @return void
     */
    public function load_admin_assets()
    {
        // Rejestrujemy skrypty
        $manifest_js = TEMPLATEPATH . '/dist/js/rev-manifest.json';
        if (file_exists($manifest_js)) {
            $admin_script = (array) json_decode(
                file_get_contents(
                    $manifest_js,
                    false,
                    stream_context_create($this->stream_opts)
                ),
                true
            );
            $admin_script = $admin_script['admin.js'];
        } else {
            $admin_script = 'admin.js';
        }

        wp_register_script(
            'admin_script',
            $this->template_uri . '/dist/js/' . $admin_script,
            ['jquery'],
            null,
            true
        );
        wp_enqueue_script('admin_script');

        // Rejestrujemy style
        $manifest_css = TEMPLATEPATH . '/dist/css/rev-manifest.json';
        if (file_exists($manifest_css)) {
            $admin_style = (array) json_decode(
                file_get_contents(
                    $manifest_css,
                    false,
                    stream_context_create($this->stream_opts)
                ),
                true
            );
            $admin_style = $admin_style['admin.css'];
        } else {
            $admin_style = 'admin.css';
        }
        wp_register_style(
            'admin_style',
            $this->template_uri . '/dist/css/' . $admin_style,
            [],
            null
        );
        wp_enqueue_style('admin_style');
    }

    /**
     * Rejestruje menu ze zmiennej config
     *
     * @return void
     */
    private function register_menus()
    {
        if (!empty($this->config['menus'])) {
            register_nav_menus($this->config['menus']);
        }
    }

    /**
     * Generuje rozmiary dla obrazków ze zmiennej config
     *
     * @return void
     */
    public function register_images()
    {
        // Dodajemy wsparcie dla 'Obrazka wyróżniającego'
        if ($this->config['enable_post_thumbnails']) {
            add_theme_support('post-thumbnails');
        }

        if (!empty($this->config['image_sizes'])) {
            // Usuwamy niechciane rozmiary
            add_filter('intermediate_image_sizes_advanced', function ($sizes) {
                foreach ($this->config['image_sizes'] as $k => $v) {
                    if (isset($sizes[$k]) && !$v) {
                        unset($sizes[$k]);
                    }
                }
                return $sizes;
            });

            // Dodajemy nowe wymiary obrazków
            if (function_exists('add_image_size')) {
                foreach ($this->config['image_sizes'] as $k => $v) {
                    if (!isset($sizes[$k]) && $v) {
                        add_image_size($k, $v[0], $v[1], $v[2]);
                    }
                }
            }
        }
    }

    /**
     * Wyłączamy domyślną wyszukiwarkę
     */
    public function disable_default_search($query, $error = true)
    {
        if (is_search() && !is_admin()) {
            $query->is_search = false;
            $query->query_vars['s'] = false;
            $query->query['s'] = false;
            if ($error == true) {
                $query->is_404 = true;
            }
        }
    }
}

/**
 * Main instance of PastaMedia.
 *
 * Returns the main instance of PastaMedia to prevent the need to use globals.
 *
 * @since  2.0
 * @return PastaMedia
 */
function pastamedia()
{
    return PastaMedia::instance();
}

// Global for backwards compatibility.
$GLOBALS['pastamedia'] = pastamedia();
