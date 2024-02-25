@props(['id'=>null, 'gen'=>null])
<x-card.card class="card mb-3">
    <x-card.card-header>
        <x-card.card-title>
            {{ __('Введиет код из письма') }}
        </x-card.card-title>
        <x-slot name="right">
            <a href="{{ route('login') }}">{{__("Назад")}}</a>
        </x-slot>
    </x-card.card-header>
    <x-card.card-body>
        <x-form.form action="{{ route('login.check-code') }}" method="post">
            <x-form.form-item>
                <x-form.label required>
                    {{ __('Введите проверочный код из письма') }}
                </x-form.label>
                <x-form.input type="text" name="code" autofocus />
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="check" value="{{ $gen }}">
            </x-form.form-item>
            <x-form.button type="submit">{{ __('Отправить') }}</x-form.button>
        </x-form.form>
    </x-card.card-body>
</x-card.card>
