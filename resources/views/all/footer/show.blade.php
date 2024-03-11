@extends('layouts.app')
@section('keywords.page'){{$show['metaKey']}}@endsection
@section('description.page'){{$show['metaDescription']}}@endsection
@section('title.page'){{$show['link']}}@endsection
@section('content.page')
    @php($searchTesting = isset($searchTesting) && $searchTesting != [] ? $searchTesting: null)
        @if($searchTesting != null)
            <x-search class="LC mt-5 p-1" :searchTesting="$searchTesting" />
        @endif
    <h1 class="h3">{{$show['link']}}</h1>
    <hr>
    <p>{!! $show['content'] !!}</p>
@endsection
