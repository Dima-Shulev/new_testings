@if($allQuestionsTest->isEmpty())
    <p>{{__('Нет ни одного созданного вопроса')}}</p>
@else
    <div class="row">
        @foreach($allQuestionsTest as $key=>$question)
            @switch($key)
            @case (0)
                    <a class='my_quest' href="{{route('question.show',['id'=>$question->testing_id,'questId'=>$question->id])}}">
                        <div class="testings" >
                        <h2 class="h4">{{__("Начать тест. Вопросов в тесте ").$count}}</h2>
                        </div>
                    </a>
                    @break
                @default
                @break
            @endswitch
        @endforeach
    </div>
@endif
