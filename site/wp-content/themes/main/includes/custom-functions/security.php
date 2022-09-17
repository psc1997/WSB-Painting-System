<?php

/**
 * Custom'owe headers'y dot. bezpieczeństwa strony.
 *
 * UWAGA:
 * W3 Total Cache nadpisuje security headers!
 * W takim wypadku należy ustawić security headers w ustawienaich wtyczki!
 */

add_action('send_headers', static function () {
    /**
     * Content Security Policy
     *
     * [...]
     *
     * @link https://infosec.mozilla.org/guidelines/web_security#content-security-policy
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP
     * @version 1.0.1
     */
    $csp_headers = [
        "default-src 'none'",
        "img-src 'self' data: https://www.google-analytics.com https://www.google.com https://stats.g.doubleclick.net https://i.ytimg.com",
        "script-src 'self' 'unsafe-inline' https://www.google-analytics.com https://www.youtube.com https://www.googletagmanager.com",
        "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
        "font-src 'self' https://fonts.gstatic.com",
        "media-src 'self'",
        "connect-src 'self'",
        "form-action 'self'",
        "base-uri 'self'",
        "frame-src https://www.youtube.com",
        "frame-ancestors 'self'",
    ];
    header('Content-Security-Policy: ' . implode('; ', $csp_headers));

    /**
     * HTTP Strict Transport Security
     *
     * HTTP Strict Transport Security (HSTS) is an HTTP header that notifies user agents to only connect to a given site over HTTPS,
     * even if the scheme chosen was HTTP. Browsers that have had HSTS set for a given site will transparently upgrade all requests to HTTPS.
     * HSTS also tells the browser to treat TLS and certificate-related errors more strictly by disabling the ability for users to bypass the error page.
     *
     * @link https://infosec.mozilla.org/guidelines/web_security#http-strict-transport-security
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Strict-Transport-Security
     */
    header('Strict-Transport-Security: max-age=63072000'); // Only connect to this site via HTTPS for the two years (recommended)

    /**
     * X-Content-Type-Options
     *
     * [...]
     *
     * @link https://infosec.mozilla.org/guidelines/web_security#x-content-type-options
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Content-Type-Options
     */
    header('X-Content-Type-Options: nosniff'); // Prevent browsers from incorrectly detecting non-scripts as scripts

    /**
     * X-Frame-Options
     *
     * [...]
     *
     * @link https://infosec.mozilla.org/guidelines/web_security#x-frame-options
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Frame-Options
     */
    header('X-Frame-Options: DENY');                           // -----||-----

    /**
     * X-XSS-Protection
     *
     * [...]
     *
     * @link https://infosec.mozilla.org/guidelines/web_security#x-xss-protection
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-XSS-Protection
     */
    header('X-XSS-Protection: 1; mode=block'); // Block pages from loading when they detect reflected XSS attacks.

    /**
     * Permissions Policy
     *
     * [...]
     *
     * @see Experimental: This is an experimental technology!
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Feature-Policy (Goodbye Feature Policy and hello Permissions Policy!)
     */
    // header('Permissions Policy: geolocation=(self)');

    /**
     * Usuwamy header informujący o CMS.
     */
    header_remove('X-Powered-By');

    /**
     * Usuwamy header informujący o serwerze (Apache/Nginx).
     */
    header_remove('server');
});

/**
 * Usunięcie funkcji oEmbed.
 *
 * @version 1.0.0
 */
add_action('init', static function () {
    // Remove the oembed/1.0/embed REST route.
    add_filter('rest_endpoints', static function ($endpoints) {
        unset($endpoints['/oembed/1.0/embed']);

        return $endpoints;
    });

    // Disable handling of internal embeds in oembed/1.0/proxy REST route.
    add_filter('oembed_response_data', static function ($data) {
        if (defined('REST_REQUEST') && REST_REQUEST) {
            return false;
        }

        return $data;
    });

    // Turn off oEmbed auto discovery.
    add_filter('embed_oembed_discover', '__return_false');

    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');

    // Remove filter of the oEmbed result before any HTTP requests are made.
    remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);

    // [...]
    remove_action('rest_api_init', 'wp_oembed_register_route');
}, 9999);

/**
 * Funkcja dodająca .htaccess blokujący dostęp do debug.log
 *
 * @version 1.0.0
 */
add_action('init', static function () {
    if (!file_exists(WP_CONTENT_DIR . '/.htaccess')) {
        file_put_contents(
            WP_CONTENT_DIR . '/.htaccess',
            '<Files *.log>
                AuthUserFile ' . WP_CONTENT_DIR . '/.htpasswd
                AuthType Basic
                AuthName "Debug"
                Require valid-user
            </Files>'
        );
    }

    if (!file_exists(WP_CONTENT_DIR . '/.htpasswd')) {
        // pasta_admin | MakaronNieRośnieNaDrzewach
        file_put_contents(
            WP_CONTENT_DIR . '/.htpasswd',
            'pasta_admin:$apr1$94njxruh$dBjoZiEZrQlYVCOdi.Wkf0'
        );
    }
});

/**
 * Usunięcie komentarza generowanego przez wtyczkę W3TC w kodize HTML:
 * "<!--Wydajność zoptymalizowana przez W3 Total Cache [...]"
 */
add_filter('w3tc_can_print_comment', static function ($w3tc_setting) {
    return false;
}, 10, 1);

/**
 * Wyłączenie interfejsu XML-RPC (plik xmlrpc.php).
 * Dodatkowo można użyć .htaccess:
 * <files xmlrpc.php>
 *   Order allow,deny
 *   Deny from all
 * </files>
 */
add_filter('xmlrpc_enabled', '__return_false');
