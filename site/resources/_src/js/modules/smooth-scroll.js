/**
 * Funkcja zarządzająca smooth scroll.
 * TODO: Refactor i porządek dla drugiej części funkcj!
 *
 * @module Smooth_Scroll
 * @version 2.0.0
 */
export default function makeSmoothScrollLogic () {
    $('a[href*="#"]')
        .not('[href="#"]')
        .not('[href="#0"]')
        .not('[href^="#js-"]')
        .not('[href^="#modal"]')
        .not('[href^="#collapse"]')
        .not('[href^="#pill"]')
        .not('[href^="#forms"]')
        .not('[href^="#fc_"]')
        .on('click', function (event) {
            if (
                location.pathname.replace(/^\//u, '') === this.pathname.replace(/^\//u, '') &&
                location.hostname === this.hostname
            ) {
                const $headerMenuBar = $('#js-header-menubar');
                let target = $(this.hash);

                target = target.length ? target : $(`[name=${this.hash.slice(1)}]`); // eslint-disable-line

                if (target.length || $(this).attr('href') === '#scroll-page-top') {
                    event.preventDefault();

                    const scrollingTime = 1000,
                        additionalScrollOffset = 150;
                    let targetOffset = 0;

                    if ($(this).attr('href') === '#scroll-page-top') {
                        targetOffset = 0;
                    } else {
                        targetOffset = target.offset().top - $headerMenuBar.height();
                    }

                    $('html, body').animate({
                        scrollTop: targetOffset - additionalScrollOffset
                    }, scrollingTime, () => true);
                }
            }
        });

    // Prevent default hash jump
    const target = window.location.hash;

    if (target) {
        const $target = $(target);

        if ($target.length > 0) {
            window.location.hash = '';
        }
    }

    $(window).on('load', () => {
        setTimeout(() => {
            if (target) {
                const $target = $(target);

                if ($target.length > 0) {
                    const scrollToOffset = 150,
                        fromTop = $target.offset().top;

                    $('html, body').animate(
                        {
                            scrollTop: fromTop - scrollToOffset
                        },
                        1000,
                        () => {
                            if (history.pushState) {
                                history.pushState(null, null, target);
                            } else {
                                window.location.hash = target;
                            }
                        }
                    );
                }
            }
        }, 100);
    });
}
