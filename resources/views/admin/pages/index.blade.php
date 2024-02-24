@extends('layouts.admin')
@section('title.page'){{__('Страницы')}}@endsection
@section('content-admin')
    <h1 class="h4">{{__('Все страницы:')}}</h1>
    <a href="{{route('admin.pages.create')}}" class="btn btn-sm btn-primary m-2">{{__('Создать страницу')}}</a>
    <div class="form-control">
        @if(count($pages) > 0)
            <table class="table">
                <tr>
                    <td><b>{{__('Id:')}}</b></td>
                    <td><b>{{__('Заголовок:')}}</b></td>
                    <td><b>{{__('Дата создания:')}}</b></td>
                    <td><b>{{__('Статус:')}}</b></td>
                    <td><b>{{__('Действие:')}}</b></td>
                </tr>

                @foreach($pages as $page)
                    <tr>
                        <td>{{$page->id}}</td>
                        <td>{{$page->name}}</td>
                        <td>{{$page->created_at}}</td>
                        <td>{{$page->active}}</td>
                        <td>
                            <a href="{{route('admin.pages.publicPage',[$page->id,$page->active])}}" class="btn btn-sm btn-{{$page->active == 1 ? 'success': 'danger'}} mb-1 me-1">{{$page->active == 1?'On':'Off'}}</a>
                            <a href="{{route('admin.pages.edit',['url' => $page->url])}}" class="btn btn-sm btn-primary mb-1">{{__('Редактировать')}}</a>
                            <a href="{{route('admin.pages.delete',$page->id)}}" class="btn btn-sm btn-danger mb-1">{{__('Удалить')}}</a>
                        </td>
                    </tr>
                @endforeach

            </table>
            {{$pages->links()}}
        @else
            <p>{{__('Пока нет ни одной созданной страницы!')}}</p>

        @endif
    </div>
@endsection
