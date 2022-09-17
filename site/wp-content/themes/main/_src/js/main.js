import 'popper.js';
import 'bootstrap';
import 'lightbox2';
import Swal from 'sweetalert2';

import makeCookies from './modules/cookie-info';
import makeHotspotsLogic from './modules/hotspots';
import makeSmoothScrollLogic from './modules/smooth-scroll';

window.Swal = Swal;

const documentReady = () => {
    makeCookies();
    makeHotspotsLogic();
    makeSmoothScrollLogic();
};

if (
    document.readyState === 'complete' ||
    (document.readyState !== 'loading' && !document.documentElement.doScroll)   // eslint-disable-line
) {
    documentReady();
} else {
    document.addEventListener('DOMContentLoaded', documentReady);
}
