@extends('layouts.main')
@section('title.page'){{__('Личный кабинет')}}@endsection
@section('content.page')

    <x-title>
        {{__('Личный кабинет')}}
    </x-title>

    <x-card>
        <x-card-body>
            <p><b>Ваш имя: </b>{{ session('name') }}</p>
        </x-card-body>

        <x-card-body>
            <p><b>Email:</b> {{ session('email') }}</p>
        </x-card-body>

        <x-card-body>
                <p><b>Баланс:</b> {{ session('balance') }} <a href="{{route('auth.room.balance')}}">{{__('Пополнить')}}</a></p>
        </x-card-body>

        <x-card-body>
            <p><b>Аватар:</b></p>
            <img src="{{ session('avatar') }}" width="220" height="220" class="mb-2">
        </x-card-body>

    </x-card>
<div class="d-flex justify-content-start">
    <a href="{{route('auth.room.editUser',($id)?$id->id:session('id'))}}" class="btn btn-primary me-3">{{__("Редактировать")}}</a>
    <x-form active="{{ route('auth.room.close') }}" method="post">
        <x-button type='submit' name="closeSession" >{{__("Выйти")}}</x-button>
    </x-form>
</div>
@endsection
