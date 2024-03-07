@extends('layouts.app')
@section('title.page'){{$getQuest->title}}@endsection
@section('content.page')
@php($answers = all_answers($getQuest->trueAnswers,$getQuest->falseAnswers))
@php($show_answers = show_answers($getQuest->testing_id))
    <form action="{{route('question.store',[$getQuest->testing_id, $getQuest->id])}}" method="post">
        @csrf
        <div class="questions">
            <x-card.card-body>
                <x-form.label class="ms-1 ps-1 pb-0">
                    <h4><b>{{$getQuest->title}}</b></h4>
                </x-form.label>
            </x-card.card-body>
            <hr class="m-0 pb-1">
            <div class="ulQuest">
                @if($show_answers == true)
                    <div class="answers">
                    <div id="trueAnsDiv">
                       <p><img src="{{asset('images/yes.webp')}}" alt="Верно"> {{__('Правильный ответ:')}}</p>
                       <hr>
                       <p>{{__('Описание ответа: '). $getQuest->description}}</p>
                   </div>
                   <div id="falseAnsDiv">
                       <p><img src="{{asset('images/x.webp')}}" alt="Не верно"> {{__('Не правильный ответ:')}}</p>
                       <hr>
                       <p>{{__('Описание ответа: ').$getQuest->description}}</p>
                   </div>
                </div>
                @endif
                    @foreach($answers[0] as $item)
                    <div class="checkLi">
                            @if(is_array($answers[1]) && count($answers[1]) > 1)
                            @php($flag = 'arr')
                                <input class="form-check-input me-2 checkbox" type="checkbox" name="checkbox[]" id="{{$item}}" value="{{$item}}"/>
                                <label for="{{$item}}"><b>{{$item}}</b></label>
                            @else
                            @php($flag = 'str')
                            <input class="form-check-input me-2" type="radio" name="radio" id="{{$item}}" value="{{$item}}"/>
                                <label for="{{$item}}"><b>{{$item}}</b></label>
                            @endif
                    </div>
                    @endforeach
                @php($hash = answers_md5($answers[1]))
                </div>
            <x-form.input type="hidden" name="questId" value="{{$getQuest->id}}"/>
            <x-form.input type="hidden" name="testId" value="{{$getQuest->testing_id}}"/>
            <div class="d-flex justify-content-end w-100">
                <button type="button" name="getResult" class="btn btn-success p-1 m-1" id="getResult">{{__('Следующий вопрос')}}</button>
                <button type="submit" name="getQuestion" class="butHidden"></button>
            </div>
   </div>
</form>
    <script src="{{asset('js/timer.js')}}"></script>
    <script type="text/javascript">
        const checkFlag = "<?php Print($flag) ?>"
        const showAnswers = "<?php Print($show_answers) ?>"
        let trueAnswers = '<?php if(gettype($answers[1]) == "string"){Print($hash);}else if(gettype($answers[1]) == "array"){Print(json_encode($hash, JSON_UNESCAPED_UNICODE));} ?>'
    </script>
    <script src="{{asset('js/buttonAnswers.js')}}"></script>
    <script src="{{asset('js/helperMd5.js')}}"></script>
@endsection
