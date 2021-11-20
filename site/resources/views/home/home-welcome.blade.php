@extends('layouts.app')

@section('title', 'PaintIT - Home')

@section('content')
    <section class="home-welcome">
        <div class="home-welcome__background-video-box">
            <video height="240" width="320" class="home-welcome__background-video" autoplay muted loop>
                <source src="{{ asset('dist/video/home-background.mp4') }}" type="video/mp4">
              Your browser does not support the video tag.
            </video>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-24 text-center">
                    <h1 class="home-welcome__title">
                        Znajdź rzeczy, które pokochasz
                    </h1>
                    <h2 class="home-welcome__title home-welcome__title--smaller">
                        Odkryj sztukę lokalnych artystów
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-24 col-md-8 offset-0 offset-md-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="">
                          X
                      </span>
                    </div>
                    <input type="text" class="form-control">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">
                            Y
                        </span>
                    </div>
                    <input type="text" class="form-control">
                </div>
            </div>
        </div>
    </section>
@endsection
