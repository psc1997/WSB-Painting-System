<?php
    $posts = $args['posts'];
?>

<section class="search-content">
    <div class="container">
        <div class="row">
            <?php if (!empty($posts)) : ?>
                <?php foreach ($posts as $key => $painting) : ?>
                    <div class="col-24 col-md-6 mb-3">
                        <?php get_template_part('template-parts/item-painting', null, ['painting' => $painting, 'new_tab' => true]); ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-24">
                    <div class="alert search-content__alert" role="alert">
                        Nie znaleziono żadnych wyników wyszukiwania
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
