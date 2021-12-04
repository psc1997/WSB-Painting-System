// import 'jquery';
import 'popper.js';
import 'bootstrap';
import 'lightbox2';

import makeCookies from './modules/cookie-info';
import makeSmoothScrollLogic from './modules/smooth-scroll';
import makeSlider from './modules/homeslider';

const documentReady = () => {
    makeCookies();
    makeSmoothScrollLogic();
    makeSlider();
};

if (
    document.readyState === 'complete' ||
    (document.readyState !== 'loading' && !document.documentElement.doScroll)   // eslint-disable-line
) {
    documentReady();
} else {
    document.addEventListener('DOMContentLoaded', documentReady);
}
