@extends('Components.user.app-layouts-user')
@section('title')
    {{ Auth::user()->name }}
@endsection
@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/Inicio-user.css') }}">
@endsection
@section('content')
    {{-- @livewire('UpdateAndDeletePost', ['postId' => $registros->id], key($registros->id)) --}}
    @livewire('MyPosts', ['userId' => Auth::user()->id], key(Auth::user()->name))
    {{-- @livewire('MyPosts', ['UserId' => Auth::user()->id], key(Auth::user()->name)) --}}
@endsection
