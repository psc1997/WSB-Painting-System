import Swiper, {Navigation} from 'swiper';

/**
 * Init dla wszystkich slider'ów.
 *
 * @version 1.0.0
 */
export default function makeSliders () {
    Swiper.use([Navigation]);

    /* eslint-disable no-new */
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
