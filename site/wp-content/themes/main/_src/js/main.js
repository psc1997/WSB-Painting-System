import 'popper.js';
import 'bootstrap';
import 'lightbox2';
import 'select2';
import Swal from 'sweetalert2';

import ajaxChangeFavourites from './modules/ajax/ajax-change-favourites';
import ajaxChangePainting from './modules/ajax/ajax-change-painting';
import ajaxSaveAccount from './modules/ajax/admin-save-account';

import makeCookies from './modules/cookie-info';
import makeHomeWelcome from './modules/home-welcome';
import makeHotspotsLogic from './modules/hotspots';
import makeInputs from './modules/inputs';
import makeSliders from './modules/sliders';
import makeSmoothScrollLogic from './modules/smooth-scroll';

window.Swal = Swal;

const documentReady = () => {
    makeCookies();
    makeHomeWelcome();
    makeHotspotsLogic();
    makeInputs();
    makeSliders();
    makeSmoothScrollLogic();

    // AJAX
    ajaxChangeFavourites();
    ajaxChangePainting();
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
