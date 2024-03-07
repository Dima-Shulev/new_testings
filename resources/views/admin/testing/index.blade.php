@extends('layouts.admin')
@section('title.page')
    {{__('Тесты')}}
@endsection
@section('content-admin')
    <h1 class="h4">{{__('Все тесты:')}}</h1>
    <a href="{{route('admin.testing.create')}}" class="btn btn-sm btn-primary m-2">{{__('Создать новый тест')}}</a>
    <div class="form-control">
        @if(count($testings) > 0)
            <table class="table">
                <tr>
                    <td><b>{{__('Id:')}}</b></td>
                    <td><b>{{__('Название теста:')}}</b></td>
                    <td><b>{{__('Дата создания:')}}</b></td>
                    <td><b>{{__('Статус:')}}</b></td>
                    <td><b>{{__('Действие:')}}</b></td>
                </tr>
                @foreach($testings as $test)
                    <tr>
                        <td>{{$test->id}}</td>
                        <td>{{$test->name_test}}</td>
                        <td>{{$test->created_at}}</td>
                        <td>{{$test->active}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{route('admin.testing.public',[$test->id,$test->active])}}" class="btn btn-sm btn-{{$test->active == 1 ? 'success': 'danger'}} mb-1 me-1">{{$test->active == 1?'On':'Off'}}</a>
                                <a href="{{route('admin.testing.edit',['id' => $test->id])}}" class="btn btn-sm btn-primary mb-1 me-1">{{__('Редактировать')}}</a>
                                <form action="{{route('admin.testing.destroy',$test->id)}}" method="post">
                                @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" name="deleteTest" class="btn btn-sm btn-danger mb-1">{{__('Удалить')}}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{$testings->links()}}
        @else
            <p>{{__('Пока нет ни одного созданного теста!')}}</p>
        @endif
    </div>
@endsection

