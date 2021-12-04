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
               <div class="swiper home-paintings__slider js-home-slider">
                   <!-- Additional required wrapper -->
                   <div class="swiper-wrapper">
                       <!-- Slides -->
                       <?php foreach ($temp as $key => $value) : ?>
                            <div class="swiper-slide">
                                <div class="card">
                                    <img src="<?= $value['img']; ?>" class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <?= $value['title']; ?>
                                        </h4>
                                        <p class="card-text">
                                            Text
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                   </div>

                   <!-- If we need navigation buttons -->
                   <div class="swiper-button-prev home-paintings__slider-button js-home-slider-button-prev"></div>
                   <div class="swiper-button-next home-paintings__slider-button js-home-slider-button-next"></div>
               </div>
                <a href="#" class="button button--ghost">
                    Zobacz więcej
                </a>
            </div>
        </div>
    </div>
</section>
