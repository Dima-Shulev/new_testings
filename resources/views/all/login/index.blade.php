@extends('layouts.auth')
@section('title.block',"Страница входа")
@section('auth.content')
    <x-errorsAndMessage.errors-any />
    <x-login.card-entrance />
@endsection

