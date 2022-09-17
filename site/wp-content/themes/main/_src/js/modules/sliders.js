import Swiper, { Navigation } from 'swiper';

/**
 * Funkcja odpowiada za wyświetlenie komunikatu o ciasteczkach.
 *
 * @module CookieInfo
 * @version 1.0.0
 */
export default function makeSliders () {
    makeHomelider();
}

/**
 * Funkcja tworzy slider na stronie głównej.
 *
 * @version 1.0.0
 */
function makeHomelider () {
    Swiper.use([Navigation]);

    const swiper = new Swiper('.js-home-slider', {
        direction: 'horizontal',
        slidesPerView: 4,
        spaceBetween: 10,
        loop: false,
        navigation: {
            nextEl: '.js-home-slider-button-next',
            prevEl: '.js-home-slider-button-prev'
        }
    });
}
