<section class="admin-register-content">
    <div class="admin-register-content__background-video-box">
        <video height="240" width="320" class="admin-register-content__background-video" autoplay muted loop>
            <source src="<?= esc_url(get_template_directory_uri()); ?>/dist/video/home-background.mp4" type="video/mp4">
            {{-- Your browser does not support the video tag. --}}
        </video>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-24 col-lg-8 offset-0 offset-lg-8">
                <div class="card admin-register-content__card">
                    <div class="card-body admin-register-content__card-body">
                        <div class="admin-register-content__form text-center">
                            <?php wp_register_form(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
