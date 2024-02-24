@props(['id' => null])
<x-card class="card mb-3">
    <x-card-header>

        <x-card-title>
            {{ __('Изменение пароля') }}

        </x-card-title>

        <x-slot name="right">
            <a href="{{ route('login') }}">{{__("Назад")}}</a>
        </x-slot>


    </x-card-header>

    <x-card-body>

        <x-form action="{{ route('login.changePass',['id'=>$id]) }}" method="post">

            <x-form-item>
                <x-label required>
                    {{ __('Введите новый пароль') }}
                </x-label>
                <x-input type="password" name="new_pass" autofocus />

            </x-form-item>

            <x-form-item>
                <x-label required>
                    {{ __('Введите пароль еще раз') }}
                </x-label>
                <x-input type="password" name="password_confirmation" />
                <input type="hidden" name="id" value="{{ $id }}"/>
            </x-form-item>

            <x-button type="submit">{{ __('Сохранить изменения') }}</x-button>
        </x-form>
    </x-card-body>

</x-card>
