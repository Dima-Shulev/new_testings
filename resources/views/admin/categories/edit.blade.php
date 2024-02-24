@extends('layouts.admin')
@section('title.page'){{__('Редактировать категорию')}}@endsection
@section('content-admin')
    <x-errorsAndMessage.errors-any/>
    <x-form.title>
        {{__('Редактировать категорию')}}
    </x-form.title>
    <hr/>
    <x-card.card>
        <a href="{{route('admin.categories')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>
        <x-form.form action="{{route('admin.categories.update',$categories->id)}}" method="post">
            <x-card.card-body>
                <x-form.label>
                    <b>{{__('Название:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="name" class="mb-2" value="{{$categories->name}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Ссылка:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="url" class="mb-2" value="{{$categories->url}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Текст:')}}</b>
                </x-form.label>
                <x-form.text-area name="content" class="mb-2">{{$categories->content}}</x-form.text-area>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Ключевые слова:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="metaKey" class="mb-2" value="{{$categories->metaKey}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Мета описание:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="metaDescription" class="mb-2" value="{{$categories->metaDescription}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Дата обновления:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="created_at" class="mb-2" placeholder="0000-00-00 00:00:00">{{$categories->created_at}}</x-form.input>
            </x-card.card-body>
            <x-form.button type='submit' name="createCategory" class="mt-2">{{__("Сохранить")}}</x-form.button>
            <a href="{{route('admin.categories')}}" class="btn btn-primary mt-2 ms-2">{{__("Назад")}}</a>
        </x-form.form>
    </x-card.card>
@endsection
