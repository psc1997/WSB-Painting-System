@extends('layouts.app')

@section('title', 'PaintIT - Home')

@section('content')
    @include('home.home-welcome')
    @include('home.home-categories')
    @include('home.home-paintings')
@endsection
