<section class="home-welcome">
    <div class="home-welcome__background-video-box">
        <video height="240" width="320" class="home-welcome__background-video" autoplay muted loop>
            <source src="{{ asset('dist/video/home-background.mp4') }}" type="video/mp4">
            {{-- Your browser does not support the video tag. --}}
        </video>
    </div>
    <div class="home-welcome__content">
        <div class="container">
            <div class="row">
                <div class="col-24 text-center">
                    <h1 class="home-welcome__content-title">
                        Znajdź rzeczy, które pokochasz
                    </h1>
                    <h2 class="home-welcome__content-title home-welcome__content-title--smaller">
                        Odkryj sztukę lokalnych artystów
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-24 col-md-10 offset-0 offset-md-7">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control home-welcome__content-input" placeholder="Znajdź artystę lub styl...">
                            <span class="icon icon-search home-welcome__content-input-icon"></span>
                            <div class="input-group-append">
                                <button class="button" type="button">
                                    Szukaj
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

