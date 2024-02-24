@extends('layouts.main')
@section('title.page'){{__('Личный кабинет')}}@endsection
@section('content.page')
        <x-errors-any/>
    <x-title>
        {{__('Личный кабинет')}}
    </x-title>
    <hr/>
    <x-card>
        <a href="{{route('auth.room')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>

        <x-form active="{{ route('auth.room.update',$userData->id) }}" method="POST" enctype="multipart/form-data">
            <x-card-body>

                <x-label>
                    <b>{{__('Ваше имя:')}}</b>
                </x-label>
                <x-input type="text" name="name" value="{{ $userData->name }}" class="mb-2"/>

            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Ваш Email:')}}</b>
                </x-label>
                <x-input type="email" name="email" value="{{ $userData->email }}" class="mb-2"/>
            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Ваш баланс:')}}</b>
                </x-label>
               <p>{{ session('balance') }} - <a href="{{route('auth.room.balance')}}">{{__('Пополнить')}}</a></p>

            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Ваш Аватар:')}}</b>
                </x-label>
                <x-input type="file" name="avatar" class="mb-2" access="avatar"/>
            </x-card-body>





            <x-button type='submit' name="saveUpdate" class="mt-2">{{__("Сохранить изменения")}}</x-button>
        </x-form>

    </x-card>
@endsection
