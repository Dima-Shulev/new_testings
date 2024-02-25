@extends('layouts.auth')
@section('title.page'){{__('Личный кабинет')}}@endsection
@section('auth.content')
    <x-errorsAndMessage.errors-any/>
    <x-form.title>
        {{__('Личный кабинет')}}
    </x-form.title>
    <hr/>
    <x-card.card>
        <a href="{{route('auth.room')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>
        <x-form.form active="{{ route('auth.room.update',$userData->id) }}" method="POST" enctype="multipart/form-data">
            <x-card.card-body>
                <x-form.label>
                    <b>{{__('Ваше имя:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="name" value="{{ $userData->name }}" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Ваш Email:')}}</b>
                </x-form.label>
                <x-form.input type="email" name="email" value="{{ $userData->email }}" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Ваш баланс:')}}</b>
                </x-form.label>
               <p>{{ session('balance') }} - <a href="{{route('auth.room.balance')}}">{{__('Пополнить')}}</a></p>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Ваш Аватар:')}}</b>
                </x-form.label>
                <x-form.input type="file" name="avatar" class="mb-2" access="avatar"/>
            </x-card.card-body>
            <x-form.button type='submit' name="saveUpdate" class="mt-2">{{__("Сохранить изменения")}}</x-form.button>
        </x-form.form>
    </x-card.card>
@endsection
