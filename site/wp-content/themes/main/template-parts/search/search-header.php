<?php
    $search_text = $args['search_text'];
    $posts_count = $args['posts_count'];
?>

<section class="search-header">
    <div class="container">
        <div class="row">
            <div class="col-24">
                <?php if (!empty($search_text)) : ?>
                    <div class="search-header__box">
                        <h1 class="search-header__title">
                            Wyniki wyszukiwania dla:<br>
                            "<span><?= esc_html($search_text); ?></span>"
                        </h1>
                    </div>
                <?php endif; ?>

                </div>
            </div>
            <div class="row">
                <div class="col-24">

                <?php if (!empty($posts_count)) : ?>
                    <div class="search-header__box search-header__box--bottom">
                        <p class="search-header__text">
                            Znalezionych wyników: <?= esc_html($posts_count); ?>
                        </p>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
