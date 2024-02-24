<x-card class="card mb-3">
    <x-card-header>
        <x-card-title>
            {{ __('Вход') }}
        </x-card-title>

        <x-slot name="right">
            <a href="{{ route('register') }}">{{__("Регистрация")}}</a>
        </x-slot>

    </x-card-header>

    <x-card-body>

        <x-form action="{{ route('login.store')}}" method="post">

            <x-form-item>
                <x-label required>
                    {{ __('Email') }}
                </x-label>
                <x-input type="email" name="email" autofocus />
            </x-form-item>

            <x-form-item>
                <x-label required>
                    {{ __('Пароль') }}
                </x-label>
                <x-input type="password" name="password" />
            </x-form-item>

            <x-form-item>
                <x-login.checkbox-auth name="remember" value="on" id="remember">

                    {{ __('Запомнить меня') }}

                </x-login.checkbox-auth>
            </x-form-item>

            <div class="d-flex justify-content-between">
                <x-button type="submit" {{--color="success" size="sm"--}}>{{ __('Войти') }}</x-button>

               <a href="{{ route('login.forget') }}" aria-current="page">{{__("Забыли пароль ?")}}</a>

            </div>
        </x-form>

    </x-card-body>

</x-card>
