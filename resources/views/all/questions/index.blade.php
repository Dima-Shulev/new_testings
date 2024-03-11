@extends('layouts.app')
@section('keywords.page'){{$options["metaKey"]}}@endsection
@section('description.page'){{$options["metaDescription"]}}@endsection
@section('title.page'){{ __("Начать прохождение теста ").$options["name_test"]}}@endsection
@section('content.page')
    <div class="border-bottom pb-3 m-5">
        <div class="d-flex justify-content-between">
                <h1 class="h2">{{__('Начать прохождение теста: ').$options["name_test"]}}</h1>
        </div>
    </div>
    <p>{{__('Для начало прохождения теста нажмите на ссылку и отвечайте на вопросы. В конце теста Вы узнаете свой результат, а так же минимальный проходной балл для сдачи.')}}</p>
    @if(isset($hour) || isset($minute) || isset($second))
        <x-questions.all_questions :allQuestionsTest="$allQuestionsTest" :count="$count" :hour="$hour" :minute="$minute" :second="$second" />
    @else
        <x-questions.all_questions :allQuestionsTest="$allQuestionsTest" :count="$count" />
    @endif
@endsection
