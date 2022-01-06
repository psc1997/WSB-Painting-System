@extends('layouts.app')

@section('content')
    <section class="login-content">
        <div class="login-content__background-video-box">
            <video height="240" width="320" class="login-content__background-video" autoplay muted loop>
                <source src="{{ asset('dist/video/home-background.mp4') }}" type="video/mp4">
                {{-- Your browser does not support the video tag. --}}
            </video>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-24 col-lg-8 offset-0 offset-lg-8">
                    <div class="card login-content__card">
                        <div class="card-body login-content__card-body">

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
        
                                <div class="row mb-3">
                                    <label for="email" class="login-content__form-label">
                                        {{ __('Adres e-mail') }}
                                    </label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror login-content__form-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <div class="text-center">
                                    <button type="submit" class="button">
                                        {{ __('Wyślij wiadomość z linkiem resetującym') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
