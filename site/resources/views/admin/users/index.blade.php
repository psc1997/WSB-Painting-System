@extends('layouts.app')
@section('title', 'PaintIT - Zarządzanie użytkownikami')
@section('content')
    <section class="admin-users-index">
        <div class="container">

            <div class="row">
                <div class="col-24">
                    <div class="admin-header-title__box">
                        <h1 class="admin-header-title__title">
                            Zarządzanie użytkownikami
                        </h1>
                        <ol class="breadcrumb admin-header-title__breadcrumbs">
                            <li class="breadcrumb-item admin-header-title__breadcrumb-item">
                                <a href="{{ route('admin.index') }}">
                                    Panel administratora
                                </a>
                            </li>
                            <li class="breadcrumb-item admin-header-title__breadcrumb-item is-active" aria-current="page">
                                Zarządzanie użytkownikami
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
                <div class="col-24 col-md-16 offset-0 offset-md-4">
                    <table class="table table-sm admin-users-index__table">
                        <thead>
                            <tr>
                                <th>
                                    Użytkownik
                                </th>
                                <th class="admin-users-index__table-col admin-users-index__table-col--role">
                                    Uprawnienia
                                </th>
                                <th class="admin-users-index__table-col admin-users-index__table-col--actions">
                                    <!-- ACTION -->
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        @if ($user->is_administrator)
                                            Administrator
                                        @else
                                            Użytkownik
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('profile.index', $user->name)}}" target="_blank" class="button button--small">
                                            <span class="icon icon-link mr-1"></span> Zobacz profil
                                        </a>
                                        <a href="{{ route('users.edit', $user->id)}}" class="button button--small">
                                            <span class="icon icon-edit mr-1"></span> Edytuj
                                        </a>
                                        <a href="#" class="button button--small">
                                            <span class="icon icon-edit mr-1"></span> Zablokuj
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id)}}" method="post" class="d-inline-block">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button class="button button--small" type="submit" {{ ($user->is_administrator) ? 'disabled' : ''; }}>
                                                <span class="icon icon-delete mr-1"></span> Usuń
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="admin-users-index__pagination">
                        {!! $users->links() !!}
                    </div>

                    <a href="{{ route('users.create') }}" class="button">
                        <span class="icon icon-plus mr-1"></span> Dodaj nowego użytkownika
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
