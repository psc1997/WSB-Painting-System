@extends('layouts.app')

@section('title', 'PaintIT - Ulubione')

@section('content')
    @include('favorites.favorites-header')
    @include('favorites.favorites-content')
@endsection