@if($allTestings->isEmpty())
    <p>{{__('Нет ни одного созданного теста')}}</p>
@else
    <div class="row">
        @foreach($allTestings as $test)
                    <a href="{{route('question',['id'=>$test->id])}}">
                            <h2 class="h4">{{$test->name_test}}</h2>
                    </a>
        @endforeach
    </div>
@endif
