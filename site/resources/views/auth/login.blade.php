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
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <label class="login-content__form-label" for="email">
                                        {{ __('Adres e-mail') }}
                                    </label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror login-content__form-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="login-content__form-label" for="password">
                                        {{ __('Hasło') }}
                                    </label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror login-content__form-input" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="form-check pl-0">
                                        <input class="form-check-input login-content__checkbox-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label login-content__checkbox-label" for="remember">
                                            {{ __('Zapamiętaj') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group mb-0 d-flex">
                                    <button type="submit" class="button mr-auto">
                                        {{ __('Zaloguj') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="button button--ghost mr-3">
                                            {{ __('Reset hasła') }}
                                        </a>
                                    @endif

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="button button--ghost">
                                            {{ __('Rejestracja') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
