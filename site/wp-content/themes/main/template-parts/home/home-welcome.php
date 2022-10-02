<section class="home-welcome">
    <div class="home-welcome__background-video-box">
        <video height="240" width="320" class="home-welcome__background-video" autoplay muted loop>
            <source src="<?= esc_url(get_template_directory_uri()); ?>/dist/video/home-background.mp4" type="video/mp4">
            {{-- Your browser does not support the video tag. --}}
        </video>
    </div>
    <div class="home-welcome__content">
        <div class="container">
            <div class="row">
                <div class="col-24 text-center">
                    <div class="home-welcome__content-box">
                        <h1 class="home-welcome__content-title">
                            Znajdź rzeczy, które pokochasz
                        </h1>
                        <h2 class="home-welcome__content-title home-welcome__content-title--smaller">
                            Odkryj <span id="js-home-welcome-typing">sztukę</span> lokalnych artystów
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-24 col-md-10 offset-0 offset-md-7">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
