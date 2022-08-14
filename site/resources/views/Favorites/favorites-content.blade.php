              
              
              <section class="favorites-content">
                    <div class="container">
                        <div class="row">
                            <?php for ($i=0; $i < 12; $i++) : ?>
                                <div class="col-24 col-md-6">
                                    <a href="#" class="profile-content__image-link">
                                        <div class="profile-content__image-box">
                                            <img src="{{ asset('/dist/img/temp/' . $i . '.jpg') }}" alt="" class="img profile-content__image">
                                        </div>
                                    </a>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </section>
         