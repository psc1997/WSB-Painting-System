<?php
    $articles = get_posts([
        'post_type' => 'article',
        'posts_per_page' => 2,
        'orderby' => 'rand',
        'order' => 'ASC',
    ]);
?>

<section class="e404-see-other">
    <div class="container">
        <div class="row">
            <div class="col-24 text-center">
                <h3 class="e404-see-other__title">
                    Nie martw się!<br>
                    Może zainteresuje Cię któryś z tych artykułów:
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-24 col-sm-16 col-md-24 col-lg-20 offset-0 offset-sm-4 offset-md-0 offset-lg-2">
                <div class="row">
                    <?php foreach ($articles as $key => $article) : ?>
                        <div class="col-24">
                            <?php get_template_part('template-parts/item-article', null, ['article' => $article]); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
