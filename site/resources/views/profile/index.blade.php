@extends('layouts.app')

@section('content')
    <section class="profile-header">
        <div class="container">
            <div class="row">
                <div class="col-24 col-md-6">
                    <img src="{{ url('/') . $user_images['avatar'] }}" alt="Avatar {{ $username ?? '' }}" class="img profile-header__avatar">
                </div>
                <div class="col-24 col-md-17 offset-0 offset-md-1">
                    <p class="profile-header__pretitle">
                        Użytkownik:
                    </p>
                    <h1 class="profile-header__title">
                        {{ $username ?? '' }}
                    </h1>
                </div>
            </div>
        </div>
    </section>
@endsection
