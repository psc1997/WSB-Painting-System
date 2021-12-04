import Swiper, { Navigation } from 'swiper';

/**
 * Slider - tworzy slider na stronie głównie
 */
export default function makeSlider () {
    Swiper.use([Navigation]);

    const swiper = new Swiper('.js-home-slider', {
        direction: 'horizontal',
        slidesPerView: 3,
        spaceBetween: 10,
        loop: true,
        navigation: {
            nextEl: '.js-home-slider-button-next',
            prevEl: '.js-home-slider-button-prev'
        }
    });
}
