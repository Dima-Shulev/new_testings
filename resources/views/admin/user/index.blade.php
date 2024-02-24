@extends('layouts.admin')
@section('title.page'){{__('Пользователи')}}@endsection
@section('content-admin')

    <h1 class="h4">{{__('Все пользователи:')}}</h1>

    <div class="form-control">
        <table class="table">
            <tr>
                <td><b>{{__('Id:')}}</b></td>
                <td><b>{{__('Логин:')}}</b></td>
                <td><b>{{__('Дата создания:')}}</b></td>
                <td><b>{{__('Статус:')}}</b></td>
                <td><b>{{__('Опубликован:')}}</b></td>
                <td><b>{{__('Действие:')}}</b></td>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->status}}</td>
                    <td>{{$user->active}}</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a href="{{route('admin.users.publicUser',[$user->id,$user->active])}}" class="btn btn-sm btn-{{$user->active == 1 ? 'success':'danger'}} mb-1 me-1">{{$user->active == 1?'On':'Off'}}</a>
                            <a href="{{route('admin.users.edit',['id' => $user->id])}}" class="btn btn-sm btn-primary mb-1 me-1">{{__('Редактировать')}}</a>
                            <a href="{{route('admin.users.delete',['id' => $user->id])}}" class="btn btn-sm btn-danger mb-1 me-1">{{__('Удалить')}}</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        {{$users->links()}}
    </div>
@endsection
