@extends('layouts.admin')
@section('title.page')
    {{__('Административная панель')}}
@endsection
@section('content-admin')
    <x-form.title>
        {{__('Административная панель')}}
    </x-form.title>
    <div class="row">
        <div class="col-12 col-md-6 mb-2">
            <x-card.card class="form-control">
                <x-card.card-body>
                    <h2 class="h5">{{__('Пользователи')}}</h2>
                    <hr>
                    <table class="table">
                        @if(!$countAndShow['showLastUser']->isEmpty())
                            @foreach($countAndShow['showLastUser'] as $us)
                                <tr>
                                    <td><b>{{__('Логин: ')}}</b></td>
                                    <td><b>{{__('Опубликован: ')}}</b></td>
                                    <td><b>{{__('Дата создания: ')}}</b></td>
                                </tr>
                                <tr>
                                    <td>{{$us->name}}</td>
                                    <td>{{$us->active?'Да':'Нет'}}</td>
                                    <td>{{$us->created_at}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>{{__('Нет ни одного пользователя!')}}</p>

                        @endif
                    </table>
                    <p><b>{{__("Общее количество: ")}}</b>{{$countAndShow['countUser']}}</p>
                </x-card.card-body>
            </x-card.card>
        </div>
        <div class="col-12 col-md-6 mb-2">
            <x-card.card class="form-control">
                <x-card.card-body>
                    <h2 class="h5">{{__('Категории')}}</h2>
                    <hr>
                    <table class="table">
                        @if(!$countAndShow['showLastCategory']->isEmpty())
                            @foreach($countAndShow['showLastCategory'] as $cat)
                                <tr>
                                    <td><b>{{__('Название: ')}}</b></td>
                                    <td><b>{{__('Опубликована: ')}}</b></td>
                                    <td><b>{{__('Дата создания: ')}}</b></td>
                                </tr>
                                <tr>
                                    <td>{{$cat->name}}</td>
                                    <td>{{$cat->active?'Да':'Нет'}}</td>
                                    <td>{{$cat->created_at}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>{{__('Нет ни одной категории!')}}</p>
                        @endif
                    </table>
                    <p><b>{{__("Общее количество: ")}}</b>{{$countAndShow['countCategory']}}</p>
                </x-card.card-body>
            </x-card.card>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <x-card.card class="form-control">
                <x-card.card-body>
                    <h2 class="h5">{{__('Тестирование')}}</h2>
                    <hr>
                    <table class="table">
                        @if(!$countAndShow['showLastTesting']->isEmpty())
                            @foreach($countAndShow['showLastTesting'] as $test)
                                <tr>
                                    <td><b>{{__('Название: ')}}</b></td>
                                    <td><b>{{__('Опубликована: ')}}</b></td>
                                    <td><b>{{__('Дата создания: ')}}</b></td>
                                </tr>
                                <tr>
                                    <td>{{$test->name_test}}</td>
                                    <td>{{$test->active?'Да':'Нет'}}</td>
                                    <td>{{$test->created_at}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>{{__('Нет ни одного теста!')}}</p>
                        @endif
                    </table>
                    <p><b>{{__("Общее количество: ")}}</b>{{$countAndShow['countTesting']}}</p>
                </x-card.card-body>
            </x-card.card>
        </div>
       {{-- <div class="col-12 col-md-6 mb-2">
            <x-card.card class="form-control">
                <x-card.card-body>
                    <h2 class="h5">{{__('Статьи')}}</h2>
                    <hr>--}}
                    {{--<table class="table">
                        @if(!$countAndShow['showLastArticle']->isEmpty())
                            @foreach($countAndShow['showLastArticle'] as $art)
                                <tr>
                                    <td><b>{{__('Заголовок: ')}}</b></td>
                                    <td><b>{{__('Опубликована: ')}}</b></td>
                                </tr>
                                <tr>
                                    <td>{{$art->title}}</td>
                                    <td>{{$art->active?'Да':'Нет'}}</td>
                                </tr>
                            @endforeach
                        @else
                            <p>{{__('Нет ни одной статьи!')}}</p>
                        @endif
                    </table>--}}
                    {{--<p><b>{{__("Общее количество: ")}}</b>{{$countAndShow['countArticle']}}</p>--}}
            {{--    </x-card.card-body>
            </x-card.card>
        </div>--}}
    </div>
@endsection


