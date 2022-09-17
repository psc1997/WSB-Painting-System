/**
 * Init.
 */
export default function makeHotspotsLogic () {
    makeHotspot();
}

/**
 * Funkcja odpowiadająca za logikę otwierania dodatkowego info na hotspot.
 *
 * @version 1.0.1
 */
function makeHotspot () {
    const $hotspots = $('.js-hotspot'),
        $popups = $('.js-hotspot-popup'),
        $image = $('.js-hotspot-image');

    $hotspots.on('mouseover click', function () {
        const $thisPopup = $(this).next('.js-hotspot-popup');

        $hotspots.removeClass('is-active');
        $popups.removeClass('is-active');

        $(this).addClass('is-active');
        $thisPopup.addClass('is-active');
    });

    // Zamykanie popup'ów na zjechanie kursorem z hotspot'a
    $hotspots.on('mouseout', () => {
        $hotspots.removeClass('is-active');
        $popups.removeClass('is-active');
    });

    // Zamykanie popup'ów po kliknięciu gdziekolwiek w zdjęcie
    $image.on('click', () => {
        $hotspots.removeClass('is-active');
        $popups.removeClass('is-active');
    });
}
