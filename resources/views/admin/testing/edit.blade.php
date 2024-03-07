@extends('layouts.admin')
@section('title.page'){{__('Редактировать тест')}}@endsection
@section('content-admin')
    <x-errorsAndMessage.errors-any/>
    <x-form.title>
        {{__('Редактировать тест')}}
    </x-form.title>
    <hr>
    <x-card.card>
        <a href="{{route('admin.testing')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>
        <x-form.form action="{{route('admin.testing.update',$testing->id)}}" method="post">
            <x-card.card-body>
                <x-form.label>
                    <b>{{__('Название:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="name_test" class="mb-2" value="{{$testing->name_test}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Описание:')}}</b>
                </x-form.label>

                <x-form.input type="text" name="content" class="mb-2" value="{{$testing->content}}"/>
            </x-card.card-body>

            <div id="questions">
                @isset($questions)
                    @for($y=0;$y<$count;$y++)
                        <x-questions.questionUpdate :num="$y+1" :questions="$questions[$y]"/>
                    @endfor
                @endisset
            </div>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Процент для сдачи:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="passing_score" class="mb-2" placeholder="проходной процент"
                         value="{{$testing->passing_score}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Дата обновления:')}}</b>
                </x-form.label>
                <x-form.input type="text" name="created_at" class="mb-2" placeholder="0000-00-00 00:00:00"/>
            </x-card.card-body>

            <x-card.card-body>
                <x-form.label class="mb-2">
                    <b>{{__('Время сдачи (можно оставить пустым):')}}</b>
                </x-form.label>
                <x-form.input type="number" name="time" class="mb-2" placeholder="Время в минутах" value="{{$testing->time}}"/>
            </x-card.card-body>
            <x-card.card-body>
                <input type="checkbox" name="show_answers" class="form-check-input me-2 checkbox" placeholder="Выводить результат,после ответа пользователя"/>
                <label class="mb-2"><b>{{__('Сообщить пользователю о правильности ответа (можно оставить пустым) ?')}}</b>
                </label>
            </x-card.card-body>
            <x-form.button type='submit' name="updateTest" class="mt-2">{{__("Сохранить")}}</x-form.button>
        </x-form.form>
    </x-card.card>
@endsection
