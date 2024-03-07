@extends('layouts.app')
@section('title.page'){{ $category['name'] }}@endsection
@section('content.page')
    <h1 class="h3">{{$category['name']}}</h1>
    <hr>
    @if((session()->has('session_user')) && (session('session_status') === 'session_user'))
        <a class="btn btn-primary" href="{{route('auth.testing.create',session('id'))}}">{{__('Создать новый тест')}}</a>
    @endif
    <p>{!! $category['content'] !!}</p>
        <x-testing.all_testings :allTestings="$allTestings"/>
@endsection
