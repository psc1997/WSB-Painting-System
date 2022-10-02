<?php
    $object = $args['object'];

    if (!in_array($object->taxonomy, ['painting_category', 'painting_type'], true)) {
        wp_die('Nieprawidłowa taxonomia!');
    }

    $posts = get_posts([
        'post_type' => 'painting',
        'posts_per_page' => -1,
        'tax_query' => [
            [
                'taxonomy' => $object->taxonomy,
                'field' => 'term_id',
                'terms' => $object->term_id,
                'include_children' => false,
            ],
        ],
    ]);
?>

<section class="paintings-content">
    <div class="container">
        <div class="row">
            <?php
                if (!empty($posts)) :
                foreach ($posts as $key => $painting) :
            ?>
                <div class="col-24 col-md-6 mb-3">
                    <?php get_template_part('template-parts/item-painting', null, ['painting' => $painting]); ?>
                </div>
            <?php
                endforeach;
                endif;
            ?>
        </div>
    </div>
</section>
