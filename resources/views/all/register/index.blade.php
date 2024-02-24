@extends('layouts.auth')
@section('title.block',"Регистрация на сайте")
@section('auth.content')
    <x-errors-any />
    <x-login.card-register />
@endsection
