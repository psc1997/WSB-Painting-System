<?php
    $categories = get_terms([
        'taxonomy' => 'painting_category',
        'number' => 6,
    ]);
?>

<?php if (!empty($categories)) : ?>
    <section class="home-categories">
        <div class="container">
            <div class="row">
                <div class="col-24 d-flex justify-content-center">
                    <ul class="nav home-categories__menu">
                        <?php foreach ($categories as $key => $category) : ?>
                            <li class="nav-item home-categories__menu-item">
                                <a href="<?= esc_url(get_term_link($category->term_id)); ?>" class="nav-link home-categories__menu-link">
                                    <?= esc_html($category->name); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
