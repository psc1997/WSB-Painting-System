<?php
    $acf_data = get_field('contact_and_social_media', 'option');
?>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-24">
                <hr class="footer__line">
            </div>
        </div>
        <div class="row">
            <div class="col-24 col-md-14">
                <h6 class="footer__title">
                    O projekcie RetroHeart:
                </h6>
                <p class="footer__text">
                    <?= esc_html(orphan('To inicjatywa stworzenia internetowego muzeum poświęconego elektronice z kilku ubiegłych dekad, zawierającego ich specyfikację, historię, zdjęcia oraz opisy. Dodatkowo w ramach serwisu piszę artykuły z informacjami "ze świata retro", a także opisuję nowe urządzenia w kolekcji czy też przebieg prac związanych z renowacją i ratunkiem tego sprzętu.')); ?>
                </p>
            </div>
            <div class="col-24 col-md-8 offset-0 offset-md-2">
                <h6 class="footer__title">
                    Kontakt:
                </h6>
                <p class="footer__text">
                    <a href="mailto:<?= esc_attr(antispambot($acf_data['mail'])); ?>" class="footer__link">
                        <?= esc_html(antispambot($acf_data['mail'])); ?>
                    </a>
                </p>
                <p class="footer__text">
                    <a href="#modalRODO" class="footer__link" data-toggle="modal">
                        Polityka prywatności
                    </a>
                </p>
                <p class="footer__text">
                    Zaprogramowane z <span style="color: #ff6961;">&#10084;</span> przez <a href="https://pastamedia.pl" class="footer__link" target="_blank">PastaMedia</a><br>
                    Wszelkie prawa zastrzeżone
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- Cookie Info -->
<div class="cookie-info js-cookie-info">
    <div class="row">
        <div class="col-24 col-sm-4 col-md-24">
            <p class="text-center">
                <span class="icon icon-cookie cookie-info__icon-cookie"></span>
            </p>
        </div>
        <div class="col-24 col-sm-20 col-md-24">
            <p class="cookie-info__text">
                <?= esc_html(orphan('Ta strona używa plików cookie w celu usprawnienia i ułatwienia dostępu do serwisu oraz prowadzenia danych statystycznych. Dalsze korzystanie z tej witryny oznacza akceptację tego stanu rzeczy.')); ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-24 col-sm-12 col-md-24">
            <a href="#modalRODO" class="button button--full-width mb-3" data-toggle="modal">
                Polityka prywatności
            </a>
        </div>
        <div class="col-24 col-sm-12 col-md-24">
            <a href="#" class="button button--full-width js-accept-cookie">
                OK
            </a>
        </div>
    </div>
</div>

<!-- RODO Modal -->
<div class="modal fade" id="modalRODO" tabindex="-1" role="dialog" aria-labelledby="RODO" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content cookie-modal__content">
            <div class="modal-header cookie-modal__header">
                <h5 class="modal-title cookie-modal__title">
                    <span class="icon icon-cookie"></span> Polityka prywatności
                </h5>
                <button type="button" class="close cookie-modal__close" data-dismiss="modal" aria-label="Close">
                    <span class="icon icon-close"></span>
                </button>
            </div>
            <div class="modal-body cookie-modal__body">
                <div class="container">
                    <div class="row">
                        <div class="col-24">
                            <p class="cookie-modal__text cookie-modal__text--stronger">
                                Czym są pliki "cookies?
                            </p>
                            <p class="cookie-modal__text">
                                <?= esc_html(orphan('Pliki "cookies" to krótkie pliki tekstowe, które są przechowywane w przeglądarce lub na dysku twardym komputera użytkownika strony internetowej, na której stosowane są pliki "cookies". W przypadku ponownej wizyty użytkownika na stronie internetowej pliki "cookies" pozwalają na rozpoznanie urządzenia końcowego użytkownika i dostosowanie strony internetowej do jego preferencji.')); ?>
                            </p>

                            <p class="cookie-modal__text cookie-modal__text--stronger">
                                Jakie funkcje pełnią pliki "cookies"?
                            </p>
                            <p class="cookie-modal__text">
                                <?= esc_html(orphan('Pliki "cookies" mogą pełnić różne funkcje. Podstawowe z nich to zapamiętywanie preferencji użytkownika i dostosowywanie do nich zawartości stron internetowych, umożliwienie przygotowania statystyk odwiedzin stron internetowych lub możliwość polecenia użytkownikowi treści, które są dla niego najbardziej odpowiednie.')); ?>
                            </p>

                            <p class="cookie-modal__text cookie-modal__text--stronger">
                                W jakim celu stosujemy pliki "cookies"?
                            </p>
                            <p class="cookie-modal__text">
                                <?= esc_html(orphan('Pliki "cookies" stosujemy w następujących celach:')); ?>
                            </p>
                            <ul class="cookie-modal__list">
                                <li>
                                    <?= esc_html(orphan('Analizy i badania zachowań użytkowników - umożliwiają odczytanie preferencji użytkowników i poprzez ich analizę ulepszanie i rozwijanie produktów i usług. Zbieranie informacji odbywa się anonimowo, bez identyfikowania danych osobowych poszczególnych użytkowników.')); ?>
                                </li>
                            </ul>

                            <p class="cookie-modal__text cookie-modal__text--stronger">
                                Czy używamy plików "cookies" pochodzących od podmiotów trzecich?
                            </p>
                            <p class="cookie-modal__text">
                                <?= esc_html(orphan('Tak, stosujemy zewnętrzne pliki cookies, pochodzące od podmiotów, z którymi współpracujemy, takich jak Google czy Facebook oraz od innych podmiotów. Z uwagi na fakt, że sposób działania niektórych plików "cookies" pochodzących od partnerów zewnętrznych może być inny, niż przedstawiony w niniejszej polityce, prosimy o zapoznanie się z informacjami na temat tych plików "cookies" dostępnymi na stronach internetowych naszych partnerów.')); ?>
                            </p>

                            <?php if (!empty($acf_data['mail'])) : ?>
                                <p class="cookie-modal__text cookie-modal__text--stronger">
                                    Kontakt z administratorem danych
                                </p>
                                <p class="cookie-modal__text">
                                    <?= esc_html(orphan('W celu skontaktowania się z administratorem danych wystarczy napisać wiadomość na adres e-mail')); ?> <a href="mailto:<?= esc_attr(antispambot($acf_data['mail'])); ?>" class="footer__link"><?= esc_html(antispambot($acf_data['mail'])); ?></a>.
                                </p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($GLOBALS['fc_video_js_exists'])) : ?>
    <script src="<?= esc_url(get_template_directory_uri()); ?>/vendors/video.js/video.min.js"></script>
<?php endif; ?>

<?php if (isset($GLOBALS['fc_youtube_exists'])) : ?>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        /**
         * Logika zarządzania odtwarzaczami YouTube (przykrywanie i odsłananie treści).
         * Musi być w tym miejscu, bo Internet Explorer nie ogarnia bundle.js.
         * 
         * @description PureJS z uwagi na ograniczenia wywołania funkcji onYouTubeIframeAPIReady() ;c
         * @version 0.1.0
         */

        // Init empty array of iframe IDs, one from each video
        var iframeIds = [];

        // For each iframe you find, add its ID to the iframeIds array
        var iframes = document.querySelectorAll(".js-youtube-embed-player");
        iframes.forEach(function(iframe) {
            iframeIds.push(iframe.id);
        });

        // Once the YouTube API is ready, for each iframeId in your array, create
        // a new YT player and give it the onReady event
        function onYouTubeIframeAPIReady() {
            if (0 < document.getElementsByClassName('js-youtube-embed-player').length) {
                iframeIds.forEach(function(iframeId) {
                    var player = new YT.Player(iframeId, {
                        events: {
                            onReady: onPlayerReady,
                            onStateChange: function (event) {
                                switch (event.data) {
                                    case YT.PlayerState.ENDED:
                                        let videoContainer = document.getElementById(iframeId).parentElement,
                                            $coverEnd = videoContainer.querySelector(".js-youtube-cover-box-end");
                                        removeClass($coverEnd, 'is-hidden');
                                        break;
                                }
                            }
                        }
                    });
                });
            }
        }

        // Init empty array of iframe YT objects for use elsewhere
        // Here I only use this to iterate through and pause all videos when
        // another begins playing
        var iframeObjects = [];

        // Shared onReady event which adds events to each video's corresponding
        // play and stop buttons
        function onPlayerReady(event) {
            var iframeObject = event.target,
                iframeElement = iframeObject.h,
                $videoContainer = iframeElement.parentElement,
                $coverStart = $videoContainer.querySelector(".js-youtube-cover-box-start"),
                $coverEnd = $videoContainer.querySelector(".js-youtube-cover-box-end"),
                $play = $videoContainer.querySelector(".js-youtube-start-button"),
                $reset = $videoContainer.querySelector(".js-youtube-restart-button");
            
            // Push current iframe object to array
            iframeObjects.push(iframeObject);

            $play.addEventListener("click", function() {            
                // Play selected video
                addClass($coverStart, 'is-hidden');
                iframeObject.playVideo();
            });
            
            $reset.addEventListener("click", function() {
                addClass($coverEnd, 'is-hidden');
                iframeObject.playVideo();
            });
        }

        // Funkcje pomocnicze
        function hasClass(element, className) {
            return !!element.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
        }

        function addClass(element, className) {
            if (!hasClass(element, className)) element.className += " "+className;
        }

        function removeClass(element, className) {
            if (hasClass(element,className)) {
                var reg = new RegExp('(\\s|^)'+className+'(\\s|$)');
                element.className=element.className.replace(reg,' ');
            }
        }
    </script>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
