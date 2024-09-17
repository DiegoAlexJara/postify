@extends('Components.user.app-layouts-user')
@section('title')
    INICIO
@endsection
@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/Inicio-user.css') }}">
@endsection
@section('content')
    @livewire('NewPost')

@endsection
@section('js')
    <script src="{{ asset('js/create-post.js') }}"></script>
@endsection
