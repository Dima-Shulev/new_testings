@if($allTestings->isEmpty())
    <p>{{__('Нет ни одной созданной категории')}}</p>
@else
    <div class="row">
        @foreach($allTestings as $test)
                    <a href="{{route('testing.show',['id'=>$test->id])}}">
                            <h2 class="h4">{{$test->name_test}}</h2>
                    </a>
        @endforeach
    </div>
@endif
