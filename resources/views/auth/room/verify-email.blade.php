@extends('layouts.auth')
@section('title.page'){{__('Подтвердите Email')}}@endsection
@section('auth.content')
    <x-form.title>
        {{__('Подтвердите Email')}}
    </x-form.title>
    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <p>Для подтверждения вашего Email, Вам было отправлено письмо на указанный Вами при регистрации почтовый ящик.<br />Если письмо не пришло</p>
        <button class="btn btn-warning" type="submit">Отправить повторно !</button>
    </form>
@endsection

