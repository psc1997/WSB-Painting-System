import Cookies from 'js-cookie';

/**
 * Funkcja odpowiada za wyświetlenie komunikatu o ciasteczkach.
 *
 * @version 1.0.0
 */
export default function makeCookies () {
    if (typeof Cookies.get('retro_heart') === 'undefined') {
        $('.js-cookie-info').addClass('is-visible');
        $('.js-accept-cookie').on('click', (event) => {
            event.preventDefault();
            Cookies.set('retro_heart', 'Cookies!_Om_nom_nom_nom!_*Cookie_Monster_eats_all_cookies*~AlpakaPozdrawia', {
                expires: 31,
                secure: location.protocol === 'https:'
            });
            $('.js-cookie-info').removeClass('is-visible');
        });
    }
}
