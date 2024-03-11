@extends('layouts.admin')
@section('title.page'){{__('Редактировать ссылку')}}@endsection
@section('content-admin')
    <x-errorsAndMessage.errors-any/>
    <x-form.title>
        {{__('Редактировать ссылку')}}
    </x-form.title>
    <hr/>
    <x-card.card>
        <a href="{{route('admin.footer')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>
        <x-form.form action="{{route('admin.footer.update',$links->id)}}" method="post">
           <x-card.card-body>
                <x-form.label><b>{{__('Название ссылки:')}}</b></x-form.label>
                <x-form.input type="text" name="name" class="mb-2" value="{{$links->link}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Ссылка URL:')}}</b></x-form.label>
                <x-form.input type="text" name="url" class="mb-2" value="{{$links->url}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Описание:')}}</b></x-form.label>
                <x-form.text-area name="content" class="mb-2">{{ $links->content }}</x-form.text-area>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Ключевые слова:')}}</b></x-form.label>
                <x-form.input type="text" name="metaKey" class="mb-2" value="{{$links->metaKey}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Мета описание:')}}</b></x-form.label>
                <x-form.input type="text" name="metaDescription" class="mb-2" value="{{$links->metaDescription}}"/>
            </x-card.card-body>

            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Позиция:')}}</b></x-form.label>
                <x-form.input type="text" name="position" class="mb-2" value="{{$links->position}}" placeholder="left или right"/>
            </x-card.card-body>


            <x-card.card-body>


                <x-form.label class="mb-2"><b>{{__('Дата обновления:')}}</b></x-form.label>
                <x-form.input type="text" name="created_at" class="mb-2" placeholder="0000-00-00 00:00:00">{{$links->created_at}}</x-form.input>
            </x-card.card-body>
            <x-form.button type='submit' name="createLink" class="mt-2">{{__("Сохранить")}}</x-form.button>
        </x-form.form>
    </x-card.card>
@endsection
