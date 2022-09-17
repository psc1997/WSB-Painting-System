<?php get_header(); ?>

<section class="page-default">
    <div class="container">
        <div class="row">
            <div class="col-24">
                <div class="page-default__content-box">
                    <div class="row">
                        <div class="col-24">
                            <h1 class="page-default__title">
                                <?php the_title(); ?>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-24">
                            <div class="page-default__text">
                                <?php
                                    if (have_posts()) {
                                        while (have_posts()) {
                                            the_post();
                                            the_title();
                                            the_content();
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer();
