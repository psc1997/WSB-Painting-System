@extends('layouts.app')

@section('content')
    <section class="admin-users-edit">
        <div class="container">

            <div class="row">
                <div class="col-24">
                    <div class="admin-header-title__box">
                        <h1 class="admin-header-title__title">
                            Dodawanie użytkownika
                        </h1>
                        <ol class="breadcrumb admin-header-title__breadcrumbs">
                            <li class="breadcrumb-item admin-header-title__breadcrumb-item">
                                <a href="{{ route('admin.index') }}">
                                    Panel administratora
                                </a>
                            </li>
                            <li class="breadcrumb-item admin-header-title__breadcrumb-item">
                                <a href="{{ route('users.index') }}">
                                    Zarządzanie użytkownikami
                                </a>
                            </li>
                            <li class="breadcrumb-item admin-header-title__breadcrumb-item is-active" aria-current="page">
                                Dodawanie użytkownika
                            </li>
                        </ol>
                        @if(session()->has('message'))
                            <div class="admin-header-title__alert">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-24 col-lg-12 offset-0 offset-lg-6">
                    <div class="card admin-users-edit__card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger admin-users-edit__alert-danger">
                                    W formularzu wystąpiły następujące błedy:
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('users.store') }}" method="POST" name="add_user">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <strong>Nazwa użytkownika</strong>
                                    <input type="text" class="form-control admin-users-edit__input" name="name" autocomplete="off" value="{{ old('name') }}" required/>
                                    <span class="text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Email</strong>
                                    <input type="email" class="form-control admin-users-edit__input" name="email" autocomplete="off" value="{{ old('email') }}" required/>
                                    <span class="text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Hasło</strong>
                                    <input type="password" class="form-control admin-users-edit__input" name="password" autocomplete="off" required/>
                                    <span class="text-danger">
                                        {{ $errors->first('password') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Powtórz hasło</strong>
                                    <div class="admin__input-box">
                                        <input type="password" class="form-control admin-users-edit__input" name="password_confirmation" autocomplete="off" required/>
                                    </div>
                                    <span class="text-danger">
                                        {{ $errors->first('password_confirmation') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Opis (opcjonalne)</strong>
                                    <textarea name="description" class="form-control admin-users-edit__input admin-users-edit__input--textarea" rows="4">{{ old('description') }}</textarea>
                                    <span class="text-danger">
                                        {{ $errors->first('city') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Administrator</strong>
                                    <label class="admin__switch">
                                        <input type="checkbox" class="admin__switch-input" name="is_administrator" value="1"/>
                                        <span class="admin__switch-slider"></span>
                                    </label>
                                    <span class="text-danger">
                                        {{ $errors->first('is_administrator') }}
                                    </span>
                                </div>

                                <button type="submit" class="button mt-3">
                                    Dodaj nowego użytkownika
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
