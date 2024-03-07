@extends('layouts.auth')
@section('title.block',"Страница входа")
@section('auth.content')
    <x-errorsAndMessage.errors-any />
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <x-login.card-entrance />
        </div>
    </div>
@endsection

