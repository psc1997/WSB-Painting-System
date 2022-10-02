<?php
    get_header();
?>

<section class="page-default">
    <div class="container">
        <div class="row">
            <div class="col-24 col-sm-16 col-md-24 col-lg-20 offset-0 offset-sm-4 offset-md-0 offset-lg-2">
                <div class="page-default__content-box">
                    <div class="row">
                        <div class="col-24">
                            <h1 class="page-default__title">
                                <?= esc_html(get_the_title()); ?>
                            </h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-24">
                            <div class="page-default__text-wyswig">
                                <?= wp_kses_post(wpautop(get_the_content())); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    get_footer();
