@if($allQuestionsTest->isEmpty())
    <p>{{__('Нет ни одного созданного вопроса')}}</p>
@else
    <div class="row">
        @foreach($allQuestionsTest as $key=>$question)
            @switch($key)
            @case (0)
                    @if(isset($hour) || isset($minute) || isset($second))
                    <a class='my_quest' href="{{route('question.showTimer',['id'=>$question->testing_id,'questId'=>$question->id,'hour'=>$hour,'minute'=>$minute,'second'=>$second,'count'=>$count])}}">
                        <div class="testings" >
                        <h2 class="h4">{{__("Начать тест. Вопросов в тесте ").$count}}</h2>
                        </div>
                    </a>
                    @else
                    <a class='my_quest' href="{{route('question.show',['id'=>$question->testing_id,'questId'=>$question->id,'count'=>$count])}}">
                        <div class="testings">
                            <h2 class="h4">{{__("Начать тест. Вопросов в тесте ").$count}}</h2>
                        </div>
                    </a>
                    @endif
                    @break
                @default
                @break
            @endswitch
        @endforeach
    </div>
@endif
