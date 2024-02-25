<x-card.card class="card mb-3">
    <x-card.card-header>
        <x-card.card-title>
            {{ __('Вход') }}
        </x-card.card-title>
        <x-slot name="right">
            <a href="{{ route('register') }}">{{__("Регистрация")}}</a>
        </x-slot>
    </x-card.card-header>
    <x-card.card-body>
        <x-form.form action="{{ route('login.store')}}" method="post">
            <x-form.form-item>
                <x-form.label required>
                    {{ __('Email') }}
                </x-form.label>
                <x-form.input type="email" name="email" autofocus />
            </x-form.form-item>
            <x-form.form-item>
                <x-form.label required>
                    {{ __('Пароль') }}
                </x-form.label>
                <x-form.input type="password" name="password" />
            </x-form.form-item>
            <x-form.form-item>
                <x-login.checkbox-auth name="remember" value="on" id="remember">
                    {{ __('Запомнить меня') }}
                </x-login.checkbox-auth>
            </x-form.form-item>
            <div class="d-flex justify-content-between">
                <x-form.button type="submit" {{--color="success" size="sm"--}}>{{ __('Войти') }}</x-form.button>
               <a href="{{ route('login.forget') }}" aria-current="page">{{__("Забыли пароль ?")}}</a>
            </div>
        </x-form.form>
    </x-card.card-body>
</x-card.card>

