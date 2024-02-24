<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}">
     <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>{{__('Вход в админку')}}</title>
</head>
<body class="bg-body-tertiary">
<div class="d-flex justify-content-between align-items-center min-vh-100 w-25 m-auto">
    <main class="flex-grow-1 py-3">
        <div class="wrapper">
            <div class="container">
                @include('message.message')
                <x-errorsAndMessage.errors-any />
                <x-card.card class="card mb-3">
                    <x-card.card-header>
                        <x-card.card-title>
                            {{ __('Вход') }}
                        </x-card.card-title>
                    </x-card.card-header>
                    <x-card.card-body>
                        <x-form.form action="{{ route('admin.entrance')}}" method="post">
                            <x-form.form-item>
                                <x-form.label required>
                                    {{ __('Ваш логин') }}
                                </x-form.label>
                                <x-form.input type="text" name="name" autofocus />
                            </x-form.form-item>
                            <x-form.form-item>
                                <x-form.label required>
                                    {{ __('Ваш пароль') }}
                                </x-form.label>
                                <x-form.input type="password" name="password" />
                            </x-form.form-item>
                            <div class="d-flex justify-content-between">
                                <x-form.button type="submit">{{ __('Войти') }}</x-form.button>
                            </div>
                        </x-form.form>
                    </x-card.card-body>
                </x-card.card>
            </div>
        </div>
    </main>
</div>
<script src="{{asset('js/bootstrap.min.js')}}" ></script>
</body>
</html>
