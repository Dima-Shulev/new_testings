@extends('layouts.auth')
@section('title.page'){{__('Личный кабинет')}}@endsection
@section('auth.content')
<div>
   <a class="btn btn-primary m-1 p-1" href="{{route('auth.testing',['id'=>$id->id])}}">{{__('Все мои тесты')}}</a>
</div>
        <div class="LC">
              <x-form.title>
                  {{__('Личный кабинет')}}
              </x-form.title>
               <hr>
              <x-card.card>
                  <x-card.card-body>
                      <p><b>{{__('Ваш имя: ')}}</b>{{ session('name') }}</p>
                  </x-card.card-body>
                  <x-card.card-body>
                      <p><b>{{__('Email:')}}</b> {{ session('email') }}</p>
                  </x-card.card-body>
                  <x-card.card-body>
                          <p><b>{{__('Баланс:')}}</b> {{ session('balance') }} <a href="{{route('auth.room.balance')}}">{{__('Пополнить')}}</a></p>
                  </x-card.card-body>
                  <x-card.card-body>
                      <p><b>{{__('Аватар:')}}</b></p>
                      <img src="{{ session('avatar') }}" width="220" height="220" class="mb-2">
                  </x-card.card-body>
              </x-card.card>
              <div class="d-flex justify-content-start">
                        <a href="{{route('auth.room.editUser',($id)?$id->id:session('id'))}}" class="btn btn-primary me-3">{{__("Редактировать")}}</a>
                        <x-form.form active="{{ route('auth.room.close') }}" method="post">
                        <x-form.button type='submit' name="closeSession" >{{__("Выйти")}}</x-form.button>
                        </x-form.form>
              </div>
        </div>
@endsection
