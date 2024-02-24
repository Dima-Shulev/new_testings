<x-card class="card mb-3">
    <x-card-header>
        <x-card-title>
            {{ __('Восстановление пароля') }}
        </x-card-title>

        <x-slot name="right">
            <a href="{{ route('login') }}">{{__("Назад")}}</a>
        </x-slot>

    </x-card-header>

    <x-card-body>

        <x-form action="{{ route('login.checkMail')}}" method="post">

            <x-form-item>
                <x-label required>
                    {{ __('Ваш Email при регистрации') }}
                </x-label>
                <x-input type="email" name="email" autofocus />
            </x-form-item>

            <x-button type="submit" {{--color="success" size="sm"--}}>{{ __('Отправить') }}</x-button>
        </x-form>

    </x-card-body>

</x-card>

