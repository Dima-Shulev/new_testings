<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="@yield('keywords.page')" />
    <meta name="description" content="@yield('description.page')" />
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>@yield('title.page', config('app.name'))</title>
</head>
<body>
<div class="d-flex flex-column justify-content-start align-items-start min-vh-100 w-100">
    @include('all.modules.menu')
    <main class="w-100 m-2 p-2">
        <div class="wrapper">
            <div class="mt-5">
                @include('message.message')
            </div>
            <div class="container">
                   @yield('auth.content')
            </div>
        </div>
    </main>
    @include('all.modules.footer')
</div>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>
