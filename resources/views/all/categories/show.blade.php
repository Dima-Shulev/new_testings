@extends('layouts.app')
@section('keywords.page'){{$category['metaKey']}}@endsection
@section('description.page'){{$category['metaDescription']}}@endsection
@section('title.page'){{$category['name']}}@endsection
@section('content.page')
    @php($searchTesting = isset($searchTesting) && $searchTesting != [] ? $searchTesting: null)
    @if($searchTesting != null)
        <x-search class="LC mt-5 p-1" :searchTesting="$searchTesting" />
    @endif
    <h1 class="h3">{{$category['name']}}</h1>
    <hr>
    @if((session()->has('session_user')) && (session('session_status') === 'session_user'))
        <a class="btn btn-primary" href="{{route('auth.testing.create',session('id'))}}">{{__('Создать новый тест')}}</a>
    @endif
    <p>{!! $category['content'] !!}</p>
        <x-testing.all_testings :allTestings="$allTestings"/>
@endsection
