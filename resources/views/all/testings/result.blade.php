@extends('layouts.app')
@section('title.page'){{ __("Результат тестирования:") }}@endsection
@section('content.page')
    <x-form.title-post>
        {{__('Результат тестирования:')}}
    </x-form.title-post>
   @isset($yesPassed)
    <div class="testSuccess">
        <h5>{{__('Ваш результат: ')}}</h5>
        <hr>
        <p>{{$yesPassed}}</p>
        <p>{{__('Проходной процент: ').$percentGo."%"}}</p>
    </div>
   @endisset
   @isset($notPassed)
    <div class="testFailure">
        <h5>{{__('Ваш результат: ')}}</h5>
        <hr>
        <p>{{$notPassed}}</p>
        <p>{{__('Проходной процент: ').$percentGo."%"}}</p>
    </div>
   @endisset
   @php(session()->forget('result'))
   <a href="{{route('category')}}">{{__('Попробовать еще раз')}}</a>
@endsection
