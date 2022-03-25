@extends('layouts.app')

@section('content')
    <section class="admin-users-index">
        <div class="container">

            @if(session()->has('message'))
                <div class="row">
                    <div class="col-24">
                        <div class="alert alert-danger admin-users-index__alert-danger">
                            {{ session()->get('message') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-24">
                    <h1 class="admin-users-index__title">
                        Zarządzanie użytkownikami
                    </h1>
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
                                <th class="admin-users-index__table-row admin-users-index__table-row--role">
                                    Uprawnienia
                                </th>
                                <th class="admin-users-index__table-row admin-users-index__table-row--show-profile">
                                    <!-- ACTION -->
                                </th>
                                <th class="admin-users-index__table-row admin-users-index__table-row--edit">
                                    <!-- CRUD -->
                                </th>
                                <th class="admin-users-index__table-row admin-users-index__table-row--lock">
                                    <!-- CRUD -->
                                </th>
                                <th class="admin-users-index__table-row admin-users-index__table-row--delete">
                                    <!-- CRUD -->
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
                                    <td>
                                        <a href="{{ route('profile.index', $user->name)}}" target="_blank" class="button button--small">
                                            <span class="icon icon-link mr-1"></span> Zobacz profil
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id)}}" class="button button--small">
                                            <span class="icon icon-edit mr-1"></span> Edytuj
                                        </a>
                                    </td>
                                    <td>
                                        <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button class="button button--small" type="submit" disabled>
                                                <span class="icon icon-delete mr-1"></span> Zablokuj
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('users.destroy', $user->id)}}" method="post">
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
