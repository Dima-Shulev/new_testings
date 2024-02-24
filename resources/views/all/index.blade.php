@extends('layouts.app')
@section('keywords.page'){{$home->metaKey}}@endsection
@section('description.page'){{$home->metaDescription}}@endsection
@section('title.page'){{$home->name}}@endsection
@section('content.page')
    <div>{{ $home->content }}</div>
@endsection
