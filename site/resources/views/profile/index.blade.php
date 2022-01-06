@extends('layouts.app')

@section('content')
    <section class="profile-header">
        <div class="container">
            <div class="row">
                <div class="col-24 col-md-6">
                    <img src="{{ url('/') . $user_images['avatar'] }}" alt="Avatar {{ $user_profile->name ?? '' }}" class="img profile-header__avatar">
                </div>
                <div class="col-24 col-md-14 offset-0 offset-md-1">
                    <p class="profile-header__pretitle">
                        Użytkownik:
                    </p>
                    <h1 class="profile-header__title">
                        {{ $user_profile->name ?? '' }}
                    </h1>
                    <h5 class="profile-header__title profile-header__title--smaller">
                        {{ $user_profile->first_name ?? '' }} {{ $user_profile->last_name ?? '' }}
                    </h5>

                    @if (!empty($user_profile->description))
                        <p class="profile-header__text">
                            {{ $user_profile->description }}
                        </p>
                    @endif
                </div>
                <div class="col-24 col-md-3 d-flex justify-content-end">
                    <div>
                        <a href="{{ route('profile.edit', Auth::user()->name) }}" class="profile-header__button-edit">
                            <div>
                                <span class="icon icon-user-edit profile-header__button-edit-icon"></span><br>
                                Edytuj
                            </div>
                        </a>
                        <a href="{{ route('profile.edit', Auth::user()->name) }}" class="profile-header__button-edit">
                            <div>
                                <span class="icon icon-image profile-header__button-edit-icon"></span><br>
                                Dodaj
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="profile-content">
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
@endsection
