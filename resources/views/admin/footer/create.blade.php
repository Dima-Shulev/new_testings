@extends('layouts.admin')
@section('title.page'){{__('Создать ссылку')}}@endsection
@section('content-admin')
    <x-errorsAndMessage.errors-any/>
    <x-form.title>
        {{__('Создать ссылку')}}
    </x-form.title>
    <hr/>
    <x-card.card>
        <a href="{{route('admin.footer')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>
        <x-form.form action="{{route('admin.footer.store')}}" method="post">
            <x-card.card-body>
                <x-form.label><b>{{__('Название:')}}</b></x-form.label>
                <x-form.input type="text" name="name" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Ссылка URL:')}}</b></x-form.label>
                <x-form.input type="text" name="url" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Описание:')}}</b></x-form.label>
                <x-form.text-area name="content"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Ключевые слова:')}}</b></x-form.label>
                <x-form.input type="text" name="metaKey" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Мета описание:')}}</b></x-form.label>
                <x-form.input type="text" name="metaDescription" class="mb-2"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Позиция:')}}</b></x-form.label>
                <x-form.input type="text" name="position" class="mb-2" placeholder="left или right"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2"><b>{{__('Дата создания:')}}</b></x-form.label>
                <x-form.input type="text" name="created_at" class="mb-2" placeholder="0000-00-00 00:00:00">{{ date("Y-m-d H:i:s") }}</x-form.input>
            </x-card.card-body>
            <x-form.button type='submit' name="createPage" class="mt-2">{{__("Создать")}}</x-form.button>
        </x-form.form>
    </x-card.card>
@endsection

