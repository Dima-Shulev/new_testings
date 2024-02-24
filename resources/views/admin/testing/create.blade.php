@extends('layouts.admin')
@section('title.page')
    {{__('Создать новый тест')}}
@endsection
@section('content-admin')
    <x-errorsAndMessage.errors-any/>
    <x-form.title>
        {{__('Создать новый тест')}}
    </x-form.title>
    <hr/>
    <x-card.card>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.testing') }}" class="btn btn-primary mb-2 text-end">{{__("Назад")}}</a>
        </div>
        <x-form.form action="{{ route('admin.testing.create') }}" method="get">

            <x-card.card-body>
                <x-form.label for="howQuestions">
                    <b>{{__('Выберите количество вопросов в тесте:')}}</b>
                </x-form.label>
                <select name="howQuestions" id="howQuestions">
                    @for($i=0;$i<150;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </x-card.card-body>
            <x-form.button type='submit' name="question" class="mt-2" id="question">{{__("Создать вопросы")}}</x-form.button>
        </x-form.form>
        <hr>
        <x-form.form action="{{ route('admin.testing.store') }}" method="post">

            <x-card.card-body>
                <x-form.label>
                    <b>{{__('Категория:')}}</b>
                </x-form.label>
                <select name="category" id="category">

                    @if(!$categories->isEmpty())
                        <option value="-/-">-/-</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    @endif
                </select>
            </x-card.card-body>
            <hr>
            <x-card.card-body>
                <x-form.label>
                    <b>{{__('Название:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="name_test" class="mb-2 mt-2" placeholder="Название теста"/>
            </x-card.card-body>

            <x-card.card-body>
                <x-form.label>
                    <b>{{__('Описание:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="content" class="mb-2 mt-2" placeholder="Описание теста"/>
            </x-card.card-body>

            <div id="questions">
                @isset($request['howQuestions'])
                    @for($y=0;$y<(int)$request['howQuestions'];$y++)
                        <x-questions.question :num="$y+1"/>
                    @endfor
                @endisset
            </div>

            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Процент для сдачи:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="passing_score" class="mb-2" placeholder="Проходной процент"/>
            </x-card.card-body>

            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Дата создания:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="created_at" class="mb-2" placeholder="0000-00-00 00:00:00"/>
            </x-card.card-body>

            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Время сдачи (можно оставить пустым):')}}</b>
                </x-form.label>
                <x-form.input type="numeric" name="time" class="mb-2" placeholder="Время в минутах"/>
            </x-card.card-body>

            <x-form.button type='submit' name="createTesting" class="mt-2">{{__("Создать тест")}}</x-form.button>
        </x-form.form>
    </x-card.card>
@endsection

