@extends('layouts.auth')
@section('title.block',"Смена пароля")
@section('auth.content')
    <x-errorsAndMessage.errors-any />
    <x-login.card-forget />
@endsection
