<?php
    $author = $args['author'];

    $posts = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => -1,
        'author' => $author->ID,
    ]);
?>

<section class="author-content">
    <div class="container">
        <div class="row">
            <?php
                if (!empty($posts)) :
                foreach ($posts as $key => $painting) :
            ?>
                <div class="col-24 col-md-6 mb-3">
                    <?php get_template_part('template-parts/item-painting', null, ['painting' => $painting, 'new_tab' => true]); ?>
                </div>
            <?php
                endforeach;
                endif;
            ?>
        </div>
    </div>
</section>
