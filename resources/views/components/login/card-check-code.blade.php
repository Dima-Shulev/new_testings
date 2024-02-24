@props(['id'=>null, 'gen'=>null])
<x-card class="card mb-3">
    <x-card-header>

        <x-card-title>
            {{ __('Введиет код из письма') }}

        </x-card-title>

        <x-slot name="right">
            <a href="{{ route('login') }}">{{__("Назад")}}</a>
        </x-slot>


    </x-card-header>

    <x-card-body>

        <x-form action="{{ route('login.check-code') }}" method="post">

            <x-form-item>
                <x-label required>
                    {{ __('Введите проверочный код из письма') }}
                </x-label>
                <x-input type="text" name="code" autofocus />

                <input type="hidden" name="id" value="{{ $id }}">
                <input type="hidden" name="check" value="{{ $gen }}">

            </x-form-item>

            <x-button type="submit">{{ __('Отправить') }}</x-button>
        </x-form>
    </x-card-body>

</x-card>
