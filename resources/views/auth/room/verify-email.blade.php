@extends('layouts.main')
@section('title.page'){{__('Подтвердите Email')}}@endsection
@section('content.page')
    <x-title>
        {{__('Подтвердите Email')}}
    </x-title>

    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <p>Для подтверждения вашего Email, Вам было отправлено письмо на указанный Вами при регистрации почтовый ящик.<br />Если письмо не пришло</p>
        <button type="submit">Отправить повторно !</button>
    </form>

@endsection

