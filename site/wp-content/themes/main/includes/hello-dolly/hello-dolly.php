<?php
/**
 * Funkcja zarządzająca Hello Dolly.
 * Na podstawie Hello Dolly 1.7.2
 *
 * @version 1.0.0
 */
add_action('admin_notices', static function () {
    if (!is_plugin_active('hello-dolly/hello.php')) {
        $chosen = get_lyric();
        $lang = '';

        if ('en_' !== substr(get_user_locale(), 0, 3)) {
            $lang = ' lang="en"';
        }

        printf(
            '<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
            'Quote from Hello Dolly song, by Jerry Herman:',
            esc_attr($lang),
            esc_attr($chosen)
        );
    }
});

/**
 * Funkcja dodająca wymagane style CSS.
 *
 * @version 1.0.0
 */
add_action('admin_head', static function () {
    echo "
	<style type='text/css'>
	#dolly {
		float: right;
		padding: 5px 10px;
		margin: 0;
		font-size: 12px;
		line-height: 1.6666;
	}
	.rtl #dolly {
		float: left;
	}
	.block-editor-page #dolly {
		display: none;
	}
	@media screen and (max-width: 782px) {
		#dolly,
		.rtl #dolly {
			float: none;
			padding-left: 0;
			padding-right: 0;
		}
	}
	</style>
	";
});

/**
 * Funkcja wyciągająca jeden akapit tekstu.
 *
 * @return string
 * @version 1.0.0
 */
function get_lyric(): string
{
    $lyrics = "Hello, Dolly
    Well, hello, Dolly
    It's so nice to have you back where you belong
    You're lookin' swell, Dolly
    I can tell, Dolly
    You're still glowin', you're still crowin'
    You're still goin' strong
    I feel the room swayin'
    While the band's playin'
    One of our old favorite songs from way back when
    So, take her wrap, fellas
    Dolly, never go away again
    Hello, Dolly
    Well, hello, Dolly
    It's so nice to have you back where you belong
    You're lookin' swell, Dolly
    I can tell, Dolly
    You're still glowin', you're still crowin'
    You're still goin' strong
    I feel the room swayin'
    While the band's playin'
    One of our old favorite songs from way back when
    So, golly, gee, fellas
    Have a little faith in me, fellas
    Dolly, never go away
    Promise, you'll never go away
    Dolly'll never go away again";

    $lyrics = explode("\n", $lyrics);
    return wptexturize($lyrics[mt_rand(0, count($lyrics) - 1)]);
}
