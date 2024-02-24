@extends('layouts.admin')
@section('title.page'){{__('Категории')}}@endsection
@section('content-admin')

    <h1 class="h4">{{__('Все категории:')}}</h1>
    <a href="{{route('admin.categories.create')}}" class="btn btn-sm btn-primary mb-1">{{__('Создать категорию')}}</a>
    <div class="form-control">
        @if($categories->isEmpty())
           <p>{{__('Нет ни одной категории!')}}</p>
       @else
            <table class="table">
            <tr>
                <td><b>{{__('Id:')}}</b></td>
                <td><b>{{__('Название:')}}</b></td>
                <td><b>{{__('Дата создания:')}}</b></td>
                <td><b>{{__('Статус:')}}</b></td>
                <td><b>{{__('Действие:')}}</b></td>
            </tr>

            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->active}}</td>
                    <td>
                        <a href="{{route('admin.categories.publicCategory',[$category->id,$category->active])}}" class="btn btn-sm btn-{{$category->active == 1 ? 'success': 'danger'}} mb-1 me-1">{{$category->active == 1?'On':'Off'}}</a>
                        <a href="{{route('admin.categories.edit',['url' => $category->url])}}" class="btn btn-sm btn-primary mb-1">{{__('Редактировать')}}</a>
                        <a href="{{route('admin.categories.delete',['id' => $category->id])}}" class="btn btn-sm btn-danger mb-1">{{__('Удалить')}}</a>
                    </td>
                </tr>
            @endforeach
            </table>
            {{$categories->links()}}
       @endif
    </div>
@endsection
