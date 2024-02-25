@props(['id' => null])
<x-card.card class="card mb-3">
    <x-card.card-header>
        <x-card.card-title>
            {{ __('Изменение пароля') }}
        </x-card.card-title>
        <x-slot name="right">
            <a href="{{ route('login') }}">{{__("Назад")}}</a>
        </x-slot>
    </x-card.card-header>
    <x-card.card-body>
        <x-form.form action="{{ route('login.changePass',['id'=>$id]) }}" method="post">
            <x-form.form-item>
                <x-form.label required>
                    {{ __('Введите новый пароль') }}
                </x-form.label>
                <x-form.input type="password" name="new_pass" autofocus />
            </x-form.form-item>
            <x-form.form-item>
                <x-form.label required>
                    {{ __('Введите пароль еще раз') }}
                </x-form.label>
                <x-form.input type="password" name="password_confirmation" />
                <input type="hidden" name="id" value="{{ $id }}"/>
            </x-form.form-item>
            <x-form.button type="submit">{{ __('Сохранить изменения') }}</x-form.button>
        </x-form.form>
    </x-card.card-body>
</x-card.card>
