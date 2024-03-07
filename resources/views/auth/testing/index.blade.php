@extends('layouts.auth')
@section('title.page'){{__('Ваши тесты')}}@endsection
@section('auth.content')
    <div class="LC">
    <h1 class="h4">{{__('Все мои тесты:')}}</h1>
    <a href="{{route('auth.testing.create',$id)}}" class="btn btn-sm btn-primary m-2">{{__('Создать новый тест')}}</a>
    <div class="form-control">
        @if(count($testings) > 0)
            <table class="table">
                <tr>
                    <td><b>{{__('Название теста:')}}</b></td>
                    <td><b>{{__('Дата создания:')}}</b></td>
                    <td><b>{{__('Статус:')}}</b></td>
                    <td><b>{{__('Действие:')}}</b></td>
                </tr>
                @foreach($testings as $test)
                <tr>
                       {{-- <td>{{$test->id}}</td>--}}
                        <td>{{$test->name_test}}</td>
                        <td>{{$test->created_at}}</td>
                        <td>{{$test->active}}</td>
                        <td>
                            <a href="{{route('auth.testing.public',[$test->id,$test->active,$test->user_id])}}"
                               class="btn btn-sm btn-{{$test->active == 1 ? 'success': 'danger'}} mb-1 me-1">{{$test->active == 1?'On':'Off'}}</a>
                            <a href="{{route('auth.testing.edit',['id' => $test->id])}}"
                               class="btn btn-sm btn-primary mb-1">{{__('Редактировать')}}</a>
                        </td>
                </tr>
                @endforeach
            </table>
            {{--{{$testings->links()}}--}}
        @else
            <p>{{__('Пока нет ни одного созданного Вами теста!')}}</p>
        @endif
    </div>
    </div>
@endsection
