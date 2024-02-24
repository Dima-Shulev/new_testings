@extends('layouts.admin')
@section('title.page'){{__('Создать категорию')}}@endsection
@section('content-admin')
    <x-errorsAndMessage.errors-any/>
    <x-form.title>
        {{__('Создать категорию')}}
    </x-form.title>
    <hr/>
    <x-card.card>
        <a href="{{route('admin.categories')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>
        <x-form.form action="{{route('admin.categories.store')}}" method="post">
            <x-card.card-body>
                <x-form.label>
                    <b>{{__('Название:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="name" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Ссылка:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="url" class="mb-2" />
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Текст:')}}</b>
                </x-form.label>
                <x-form.text-area name="content" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Ключевые слова:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="metaKey" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Мета описание:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="metaDescription" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Дата создания:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="created_at" class="mb-2" placeholder="0000-00-00 00:00:00">{{ date("Y-m-d H:i:s") }}</x-form.input>
            </x-card.card-body>
            <x-form.button type='submit' name="createCategory" class="mt-2">{{__("Создать")}}</x-form.button>
        </x-form.form>
    </x-card.card>
@endsection

