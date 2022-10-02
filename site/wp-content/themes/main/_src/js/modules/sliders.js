import Swiper, {Navigation} from 'swiper';

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

    /* eslint-disable no-new */
    new Swiper('.js-home-last-slider', {
        direction: 'horizontal',
        slidesPerView: 4,
        spaceBetween: 10,
        loop: false,
        navigation: {
            nextEl: '.js-home-last-slider-button-next',
            prevEl: '.js-home-last-slider-button-prev'
        }
    });

    new Swiper('.js-home-artist-slider', {
        direction: 'horizontal',
        slidesPerView: 4,
        spaceBetween: 10,
        loop: false,
        navigation: {
            nextEl: '.js-home-artist-slider-button-next',
            prevEl: '.js-home-artist-slider-button-prev'
        }
    });

    new Swiper('.js-painting-more-slider', {
        direction: 'horizontal',
        slidesPerView: 4,
        spaceBetween: 10,
        loop: false,
        navigation: {
            nextEl: '.js-painting-more-slider-button-next',
            prevEl: '.js-painting-more-slider-button-prev'
        }
    });
}
