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
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
        
                                <div class="form-group">
                                    <label for="name" class="login-content__form-label">
                                        {{ __('Nazwa użytkownika') }}
                                    </label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror login-content__form-input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <div class="form-group">
                                    <label for="email" class="login-content__form-label">
                                        {{ __('Adres e-mail') }}
                                    </label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror login-content__form-input" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <div class="form-group">
                                    <label for="password" class="login-content__form-label">
                                        {{ __('Hasło') }}
                                    </label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror login-content__form-input" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
        
                                <div class="form-group">
                                    <label for="password-confirm" class="login-content__form-label">
                                        {{ __('Potwierdź hasło') }}
                                    </label>
                                    <input id="password-confirm" type="password" class="form-control login-content__form-input" name="password_confirmation" required autocomplete="new-password">
                                </div>
        
                                <div class="text-center">
                                    <button type="submit" class="button">
                                        {{ __('Zarejestruj') }}
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
