@extends('layouts.app')
@section('title.page'){{ $category['name'] }}@endsection
@section('content.page')
    <h1 class="h3">{{$category['name']}}</h1>
    <hr>
    <p>{!! $category['content'] !!}</p>
        <x-testing.all_testings :allTestings="$allTestings"/>
@endsection
