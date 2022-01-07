<?php
    $temp = [
        [
            'img' => 'https://placekitten.com/600/400',
            'title' => 'Phoenix',
        ],[
            'img' => 'https://placekitten.com/601/401',
            'title' => 'Blue',
        ],[
            'img' => 'https://placekitten.com/602/402',
            'title' => 'Something',
        ],[
            'img' => 'https://placekitten.com/603/403',
            'title' => 'Makaron',
        ],[
            'img' => 'https://placekitten.com/604/404',
            'title' => 'Pierogi',
        ]
    ];
?>

<section class="home-paintings">
    <div class="container">
        <div class="row">
            <div class="col-24">
                <h2 class="home-paintings__title">
                    Ostatnio dodane
                </h2>
                <!-- Slider main container -->
                <div class="position-relative mb-5">
                    <div class="swiper home-paintings__slider js-home-slider">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper home-paintings__slider-wrapper">
                            <!-- Slides -->
                            <?php foreach ($temp as $key => $value) : ?>
                            <div class="swiper-slide">
                                <a class="card home-paintings__item">
                                    <img src="<?= $value['img']; ?>" class="card-img-top home-paintings__item-image"
                                        alt="">
                                    <div class="card-body">
                                        <div class="text-right">
                                            <button class="home-paintings__item-button-heart">
                                                <span class="icon-heart-empty home-paintings__item-button-icon"></span>
                                            </button>
                                        </div>
                                        <div class="home-paintings__item-content">
                                            <h4 class="card-title home-paintings__item-title">
                                                "<?= $value['title']; ?>"
                                            </h4>
                                            <h5 class="card-text home-paintings__item-author">
                                                Imię i nazwisko
                                            </h5>
                                            <p class="home-paintings__item-type">
                                                Akryl na płótnie<br>
                                                50x70 cm
                                            </p>
                                            <div class="text-center">
                                                @for ($i = 0; $i < 4; $i++) <span
                                                    class="badge home-paintings__item-tag">#abstrakcja</span>
                                                    @endfor
                                                    <span class="badge home-paintings__item-tag">...</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- If we need navigation buttons -->
                    <div
                        class="swiper-button-prev home-paintings__slider-button home-paintings__slider-button--left js-home-slider-button-prev">
                    </div>
                    <div
                        class="swiper-button-next home-paintings__slider-button home-paintings__slider-button--right js-home-slider-button-next">
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('paintings.index'); }}" class="button button--ghost button--big">
                        Zobacz więcej
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
