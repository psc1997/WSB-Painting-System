@extends('layouts.app')

@section('title', 'PaintIT - Obrazy')

@section('content')
    @include('painting.painting-categories')
    @include('paintings.paintings-index')
@endsection
