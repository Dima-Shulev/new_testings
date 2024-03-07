@extends('layouts.admin')
@section('title.page'){{__('Редактировать данные пользователя')}}@endsection
@section('content-admin')
    <x-errorsAndMessage.errors-any/>
    <x-form.title>
        {{__('Редактировать данные пользователя')}}
    </x-form.title>
    <hr/>
    <x-card.card>
        <a href="{{route('admin.users')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>
        <x-form.form active="{{ route('admin.users.update',(int)$users->id) }}" method="post">
            <x-card.card-body>
                <x-form.label>
                    <b>{{__('Логин:')}}</b>
                </x-form.label>
                <x-form.input type="hidden" name="id" value="{{ $users->id }}"/>
                <x-form.input type="text" name="name" value="{{ $users->name }}" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Email:')}}</b>
                </x-form.label>
                <x-form.input type="email" name="email" value="{{ $users->email }}" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Пароль:')}}</b>
                </x-form.label>
                <x-form.input type="password" name="password" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Дата создания:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="created_at" value="{{ $users->created_at }}" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Баланс:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="balance" value="{{ $users->balance }}" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Статус:')}}</b>
                </x-form.label>
                <x-login.select-status class="mb-3 ms-2" name='status' value="user">{{ $users->status }}</x-login.select-status>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Pay:')}}</b>
                </x-form.label>
                <x-login.select-pay class="mb-3 ms-2" name='pay' value="no">{{ $users->pay }}</x-login.select-pay>
            </x-card.card-body>
            <x-form.button type='submit' name="saveUpdate" class="mt-2">{{__("Сохранить")}}</x-form.button>
        </x-form.form>
    </x-card.card>
@endsection
