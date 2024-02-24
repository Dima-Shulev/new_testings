@extends('layouts.admin')
@section('title.page'){{__('Редактировать страницу')}}@endsection
@section('content-admin')
    <x-errorsAndMessage.errors-any/>
    <x-form.title>
        {{__('Редактировать страницу')}}
    </x-form.title>
    <hr/>
    <x-card.card>
        <a href="{{route('admin.pages')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>
        <x-form.form action="{{route('admin.pages.update',$pages->id)}}" method="post">
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Домашная страница:')}}</b><input class="form-check-input ms-2" type="checkbox" name="home"/>
                </x-form.label>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label>
                    <b>{{__('Название:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="name" class="mb-2" value="{{$pages->name}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Ссылка:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="url" class="mb-2" value="{{$pages->url}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Описание:')}}</b>
                </x-form.label>
                <x-form.text-area name="content" class="mb-2">{{ $pages->content }}</x-form.text-area>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Ключевые слова:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="metaKey" class="mb-2" value="{{$pages->metaKey}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Мета описание:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="metaDescription" class="mb-2" value="{{$pages->metaDescription}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Дата обновления:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="created_at" class="mb-2" placeholder="0000-00-00 00:00:00">{{$pages->created_at}}</x-form.input>
            </x-card.card-body>
            <x-form.button type='submit' name="createPage" class="mt-2">{{__("Сохранить")}}</x-form.button>
        </x-form.form>
    </x-card.card>
@endsection
