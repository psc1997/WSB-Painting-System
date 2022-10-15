import 'popper.js';
import 'bootstrap';
import 'lightbox2';
import Swal from 'sweetalert2';

import ajaxChangeFavourites from './modules/ajax/ajax-change-favourites';
import ajaxSaveAccount from './modules/ajax/admin-save-account';

import makeCookies from './modules/cookie-info';
import makeHomeWelcome from './modules/home-welcome';
import makeHotspotsLogic from './modules/hotspots';
import makeSliders from './modules/sliders';
import makeSmoothScrollLogic from './modules/smooth-scroll';

window.Swal = Swal;

const documentReady = () => {
    makeCookies();
    makeHomeWelcome();
    makeHotspotsLogic();
    makeSliders();
    makeSmoothScrollLogic();

    // AJAX
    ajaxChangeFavourites();
    ajaxSaveAccount();

    $('[data-toggle="tooltip"]').tooltip();
};

if (
    document.readyState === 'complete' ||
    (document.readyState !== 'loading' && !document.documentElement.doScroll)   // eslint-disable-line
) {
    documentReady();
} else {
    document.addEventListener('DOMContentLoaded', documentReady);
}
