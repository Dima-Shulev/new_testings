<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta id="_token" name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   {{-- <script src="https://cdn.tiny.cloud/1/zih6e9mm4ir5yy8v9kjgqzs0ljdxqo1ulskf88q0sdzgfrmr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('js/tinymce.js')}}"></script>--}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>@yield('title.page', config('app.name'))</title>
</head>
<body class="bg-body-tertiary">
<div class="d-flex justify-content-between min-vh-100">
    @include('admin.modules.menu')
    <main class="flex-grow-1 py-3">
        <div class="wrapper">
            <div class="container">
                @include('message.message')
                @yield("content-admin")
            </div>
        </div>
    </main>
</div>
<script src="{{asset('js/bootstrap.min.js')}}" ></script>

</body>
</html>
