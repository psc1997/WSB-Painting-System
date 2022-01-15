@extends('layouts.app')

@section('content')
    <section class="profile-header">
        <form action="{{ route('profile.update', ['username' => $user_profile->name]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                @if(session()->has('message'))
                    <div class="row">
                        <div class="col-24">
                            <div class="alert alert-danger">
                                {{ session()->get('message') }}
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-24 col-md-6">
                        <img src="{{ url('/') . $user_images['avatar'] }}" alt="Avatar {{ $user_profile->name ?? '' }}" class="img profile-header__avatar">
                    </div>
                    <div class="col-24 col-md-14 offset-0 offset-md-1">
                        <p class="profile-header__pretitle">
                            Użytkownik:
                        </p>
                        <h1 class="profile-header__title mb-3">
                            {{ $user_profile->name ?? ''; }}
                        </h1>

                        <div class="row">
                            <div class="col-24 col-md-12">
                                <input type="text" class="mb-2 form-control profile-header__input" name="user_first_name" value="{{ $user_profile->first_name ?? ''; }}" placeholder="Imię">        
                            </div>
                            <div class="col-24 col-md-12">
                                <input type="text" class="mb-2 form-control profile-header__input" name="user_last_name" value="{{ $user_profile->last_name ?? ''; }}" placeholder="Nazwisko">                                
                            </div>
                        </div>

                        <textarea class="mb-2 form-control profile-header__input profile-header__input--textarea" name="user_description" rows="8" placeholder="Opis">{{ $user_profile->description ?? ''; }}</textarea>
                    </div>
                    <div class="col-24 col-md-3 d-flex justify-content-end">
                        <div>
                            <input type="text" name="form_type" value="update_profile" hidden>
                            <button type="submit" class="profile-header__button-edit">
                                <div>
                                    <span class="icon icon-user-edit profile-header__button-edit-icon"></span><br>
                                    Zapisz
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
