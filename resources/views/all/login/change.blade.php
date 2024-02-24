@extends('layouts.auth')
@section('title.block',"Страница входа")
@section('auth.content')
    <x-errors-any/>
    <x-login.new-password :id="$id" />
@endsection
