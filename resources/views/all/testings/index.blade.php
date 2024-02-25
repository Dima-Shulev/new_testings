@extends('layouts.app')
@section('title.page'){{ __("Тестирование:") }}@endsection
@section('content.page')
    <x-form.title-post>
        {{__('Тестирование:')}}
    </x-form.title-post>
    <p>{{__('В данном примере представлено тестирование. Это не просто тест, который написан по данной теме, а система с управлением через панель администратора по созданию, редактированию, активации, удалению теста, а также установка необходимого количества вопросов. Темы могут быть любыми и иметь любую направленность.')}}</p>
    <x-modules.all_testings :allTestings="$allTestings"/>
@endsection
