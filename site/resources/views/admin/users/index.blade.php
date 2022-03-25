@extends('layouts.app')

@section('content')
    <section class="admin">
        <div class="container">

            @if(session()->has('message'))
                <div class="row">
                    <div class="col-24">
                        <div class="alert alert-danger admin__alert-danger">
                            {{ session()->get('message') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-24">
                    <table class="table table-sm admin__table">
                        <thead>
                            <tr>
                                <th>
                                    Użytkownik
                                </th>
                                <th class="admin__table-row admin__table-row--user-role">
                                    Uprawienia administratora
                                </th>
                                <th class="admin__table-row admin__table-row--show-profile">
                                    <!-- ACTION -->
                                </th>
                                <th class="admin__table-row admin__table-row--edit">
                                    <!-- CRUD -->
                                </th>
                                <th class="admin__table-row admin__table-row--delete">
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
                                    <td class="text-center">
                                        @if ($user->is_administrator)
                                            <span class="admin__item-color-square admin__item-color-square--true"></span>
                                        @else
                                            <span class="admin__item-color-square admin__item-color-square--false"></span>
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
                                                <span class="icon icon-delete mr-1"></span> Usuń
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="admin__pagination">
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-24">
                    <a href="{{ route('users.create') }}" class="button">
                        <span class="icon icon-plus mr-1"></span> Dodaj nowego użytkownika
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
