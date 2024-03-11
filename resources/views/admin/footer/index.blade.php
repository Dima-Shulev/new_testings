@extends('layouts.admin')
@section('title.page'){{__('Ссылки footer')}}@endsection
@section('content-admin')
    <h1 class="h4">{{__('Все ссылки footer:')}}</h1>
    <a href="{{route('admin.footer.create')}}" class="btn btn-sm btn-primary m-2">{{__('Создать ссылку')}}</a>
    <div class="form-control">
        @if(count($links) > 0)
            <table class="table">
                <tr>
                    <td><b>{{__('Id:')}}</b></td>
                    <td><b>{{__('Ссылка:')}}</b></td>
                    <td><b>{{__('Дата создания:')}}</b></td>
                    <td><b>{{__('Статус:')}}</b></td>
                    <td><b>{{__('Действие:')}}</b></td>
                </tr>

                @foreach($links as $link)
                    <tr>
                        <td>{{$link->id}}</td>
                        <td>{{$link->link}}</td>
                        <td>{{$link->created_at}}</td>
                        <td>{{$link->active}}</td>
                        <td>
                            <div class="d-flex justify-content-start">
                                <a href="{{route('admin.footer.publicFooter',[$link->id,$link->active])}}" class="btn btn-sm btn-{{$link->active == 1 ? 'success': 'danger'}} mb-1 me-1">{{$link->active == 1?'On':'Off'}}</a>
                                <a href="{{route('admin.footer.edit',['url' => $link->url])}}" class="btn btn-sm btn-primary mb-1 me-1">{{__('Редактировать')}}</a>
                                <form action="{{route('admin.footer.delete',$link->id)}}" method="post">
                                @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" name="deleteFooter" class="btn btn-sm btn-danger mb-1">{{__('Удалить')}}</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </table>
            {{$links->links()}}
        @else
            <p>{{__('Пока нет ни одной созданной ссылки!')}}</p>
        @endif
    </div>
@endsection
