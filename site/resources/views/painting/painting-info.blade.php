<section class="painting-info">
    <div class="container">
        <div class="row">
            <div class="col-24 col-md-11">
                <img src="https://placekitten.com/1000/1000" class="img-fluid painting-info__image" alt="">
            </div>
            <div class="col-24 col-md-11 offset-0 offset-md-2">
                <div class="painting-info__description">
                    
                    @if ((!empty($painting_fn)) || (!empty($painting_ln)))
                        <h2 class="painting-info__description-author">
                            {{ $painting_fn }} {{ $painting_ln }}
                        </h2>
                    @endif

                        <p class="painting-info__description-likes">
                            <span class="icon-heart-full painting-info__description-heart"></span> 2102
                        </p>

                    @if (!empty($painting_data->name))
                        <h3 class="painting-info__description-title">
                            {{ $painting_data->name }}
                        </h3>
                    @endif
                    
                    @if (!empty($painting_data->painting_technique))
                        <p class="painting-info__description-size">
                            {{ $painting_data->painting_technique }}
                        </p>
                    @endif

                    @if (!empty($painting_cat))
                        <p class="painting-info__description-category">
                            {{ $painting_cat }}
                        </p>
                    @endif

                    <div class="painting-info__description-about-author">
                    
                    @if (!empty($painting_data->description))
                        <p class="painting-info__description-about-text">
                            {{ $painting_data->description }}
                        </p>
                    @endif
                        
                    </div>
                 </div>
            </div>
        </div>
    </div>
</section>