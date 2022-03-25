@extends('layouts.app')

{{-- @section('title', 'PaintIT - Home') --}}

@section('content')
    <section class="admin-home-header">
        <div class="container">
            <div class="row">
                <div class="col-24">
                    <h1 class="admin-home-header__title">
                        Panel administratora
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-24 col-md-3">
                    <a href="#" class="admin-home-header__button-edit">
                        <div class="admin-home-header__button-edit-content">
                            <div>
                                <span class="icon icon-user-edit admin-home-header__button-edit-icon"></span><br>
                                Obrazy
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-24 col-md-3">
                    <a href="{{ route('users.index') }}" class="admin-home-header__button-edit">
                        <div class="admin-home-header__button-edit-content">
                            <div>
                                <span class="icon icon-user-edit admin-home-header__button-edit-icon"></span><br>
                                Użytkownicy
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
