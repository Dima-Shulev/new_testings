@extends('layouts.app')
@section('title.page'){{ __("Начать прохождение теста") }}@endsection
@section('content.page')
    <x-form.title-post>
        {{__('Начать прохождение теста:')}}
    </x-form.title-post>
    <p>{{__('Для начало прохождения теста нажмите на ссылку и отвечайте на вопросы. В конце теста Вы узнаете свой результат, а так же минимальный проходной балл для сдачи.')}}</p>
    <x-questions.all_questions :allQuestionsTest="$allQuestionsTest" :count="$count"/>
@endsection