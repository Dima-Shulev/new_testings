@extends('layouts.app')
@section('title.page'){{ __("Результат тестирования:") }}@endsection
@section('content.page')
    <div class="border-bottom pb-3 m-5">
        <div class="d-flex justify-content-between">
            <h1 class="h2">{{__('Результат тестирования:')}}</h1>
        </div>
    </div>
   @isset($yesPassed)
    <div class="testSuccess">
        <h4>{{__('Ваш результат: ')}}</h4>
        <hr>
        <p>{{__('Поздравляю, Вы прошли тест ').$name}}</p>
        <p>{{__('Ваш результат - ').$yesPassed."%"}}</p>
        <p>{{__('Проходной балл: ').$percentGo."%"}}</p>
    </div>
   @endisset
   @isset($notPassed)
    <div class="testFailure">
        <h4>{{__('Ваш результат: ')}}</h4>
        <hr>
        <p>{{__('К сожалению, Вы не прошли тест ').$name}}</p>
        <p>{{__('Ваш результат - ').$notPassed."%"}}</p>
        <p>{{__('Проходной процент: ').$percentGo."%"}}</p>
    </div>
   @endisset
   @php(session()->forget('result'))
   <a href="{{route('category')}}" class="btn btn-primary mt-1">{{__('Попробовать еще раз')}}</a>
@endsection
