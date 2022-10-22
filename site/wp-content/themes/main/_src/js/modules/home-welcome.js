import Typed from 'typed.js';

/**
 * [...]
 *
 * @version 1.0.0
 */
export default function makeHomeWelcome () {
    const $homeWelcomeTyping = $('#js-home-welcome-typing');

    if (0 < $homeWelcomeTyping.length) {
        const typed = new Typed('#js-home-welcome-typing', {
            strings: [
                'sztukę',
                'piękno',
                'twórczość',
                'pomysłowość'
            ],
            typeSpeed: 100,
            backSpeed: 50,
            stringStartDelay: 1250,
            loop: true
        });
    }
}
