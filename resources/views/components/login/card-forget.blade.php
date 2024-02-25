<x-card.card class="card mb-3">
    <x-card.card-header>
        <x-card.card-title>
            {{ __('Восстановление пароля') }}
        </x-card.card-title>
        <x-slot name="right">
            <a href="{{ route('login') }}">{{__("Назад")}}</a>
        </x-slot>
    </x-card.card-header>
    <x-card.card-body>
        <x-form.form action="{{ route('login.checkMail')}}" method="post">
            <x-form.form-item>
                <x-form.label required>
                    {{ __('Ваш Email при регистрации') }}
                </x-form.label>
                <x-form.input type="email" name="email" autofocus />
            </x-form.form-item>
            <x-form.button type="submit" {{--color="success" size="sm"--}}>{{ __('Отправить') }}</x-form.button>
        </x-form.form>
    </x-card.card-body>
</x-card.card>

