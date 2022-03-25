@extends('layouts.app')

@section('content')
    <section class="admin">
        <div class="container">
            <div class="row">
                <div class="col-24 col-lg-12 offset-0 offset-lg-6">
                    <div class="card admin__card">
                        <div class="card-header admin__card-heder">
                            <h5 class="card-title mb-0">
                                Użytkownicy - Edytuj użytkownika
                            </h5>
                        </div>
                        <div class="card-body admin__card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger admin__alert-danger">
                                    W formularzu wystąpiły następujące błedy:
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('users.update', $data->id) }}" method="POST" name="update_user">
                                {{ csrf_field() }}
                                @method('PATCH')

                                <div class="form-group">
                                    <strong>Nazwa użytkownika</strong>
                                    <div class="admin__input-box">
                                        <input type="text" class="form-control admin__input-text" name="name" autocomplete="off" value="{{ $data->name }}" required/>
                                    </div>
                                    <span class="text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Email</strong>
                                    <div class="admin__input-box">
                                        <input type="email" class="form-control admin__input-text" name="email" autocomplete="off" value="{{ $data->email }}" required/>
                                    </div>
                                    <span class="text-danger">
                                        {{ $errors->first('email') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Hasło</strong>
                                    <div class="admin__input-box">
                                        <input type="password" class="form-control admin__input-text" name="password" autocomplete="off"/>
                                    </div>
                                    <span class="text-danger">
                                        {{ $errors->first('password') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Powtórz hasło</strong>
                                    <div class="admin__input-box">
                                        <input type="password" class="form-control admin__input-text" name="password_confirmation" autocomplete="off"/>
                                    </div>
                                    <span class="text-danger">
                                        {{ $errors->first('password_confirmation') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Miasto (opcjonalne)</strong>
                                    <div class="admin__input-box">
                                        <input type="text" class="form-control admin__input-text" name="city" autocomplete="off" value="{{ $data->city }}"/>
                                    </div>
                                    <span class="text-danger">
                                        {{ $errors->first('city') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Opis (opcjonalne)</strong>
                                    <div class="admin__input-box">
                                        <textarea name="description" class="form-control admin__input-text admin__input-text--textarea" rows="4">{{ $data->description }}</textarea>
                                    </div>
                                    <span class="text-danger">
                                        {{ $errors->first('city') }}
                                    </span>
                                </div>

                                <div class="form-group">
                                    <strong>Administrator</strong>
                                    <label class="admin__switch">
                                        <input type="checkbox" class="admin__switch-input" name="is_administrator" value="1" {{ $data->is_administrator == 1 ? 'checked' : '' }}/>
                                        <span class="admin__switch-slider"></span>
                                    </label>
                                    <span class="text-danger">
                                        {{ $errors->first('is_administrator') }}
                                    </span>
                                </div>

                                <button type="submit" class="button mt-3">
                                    <span class="icon icon-save mr-1"></span> Zapisz zmiany
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
