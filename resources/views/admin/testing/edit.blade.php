@extends('layouts.admin')
@section('title.page')
    {{__('Редактировать тест')}}
@endsection
@section('content-admin')
    <x-errors-any/>
    <x-title>
        {{__('Редактировать тест')}}
    </x-title>
    <hr>
    <x-card>
        <a href="{{route('admin.testing')}}" class="btn btn-primary mb-2">{{__("Назад")}}</a>

        <x-form action="{{route('admin.testing.update',$testing->id)}}" method="post">

            <x-card-body>
                <x-label>
                    <b>{{__('Название:')}}</b>
                </x-label>
                <x-input type="text" name="name_test" class="mb-2" value="{{$testing->name_test}}"/>
            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Описание:')}}</b>
                </x-label>

                <x-input type="text" name="content" class="mb-2" value="{{$testing->content}}"/>
            </x-card-body>

            <div id="questions">
                @isset($questions)
                    @for($y=0;$y<$count;$y++)
                        <x-modules.questionUpdate :num="$y+1" :questions="$questions[$y]"/>
                    @endfor
                @endisset
                {{--<x-button type='submit' name="addQuest" class="mt-2" value="addQuest">{{__("Добавить вопрос")}}</x-button>--}}
            </div>
            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Процент для сдачи:')}}</b>
                </x-label>
                <x-input type="text" name="passing_score" class="mb-2" placeholder="проходной процент"
                         value="{{$testing->passing_score}}"/>
            </x-card-body>

            <x-card-body>
                <x-label class="mb-2">
                    <b>{{__('Дата обновления:')}}</b>
                </x-label>
                <x-input type="text" name="created_at" class="mb-2" placeholder="0000-00-00 00:00:00"/>
            </x-card-body>
            <x-button type='submit' name="updateTest" class="mt-2">{{__("Сохранить")}}</x-button>
        </x-form>
    </x-card>
@endsection
