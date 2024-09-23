@extends('Components.user.app-layouts-user')
@section('title')
    {{ $name }}
@endsection
@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/Inicio-user.css') }}">
@endsection
@section('content')
    {{-- @livewire('MyPosts', ['userId' => Auth::user()->id], key(Auth::user()->name)) --}}
    @livewire('MyPosts', ['userId' => $userId], key($userId));
@endsection
