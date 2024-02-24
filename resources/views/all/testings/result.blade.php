@extends('layouts.main')
@section('title.page'){{ __("Результат тестирования:") }}@endsection
@section('content.page')
    <x-title-post>
        {{__('Результат тестирования:')}}
    </x-title-post>
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
   <a href="{{route('testing')}}">{{__('Попробовать еще раз')}}</a>
@endsection
