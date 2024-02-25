@extends('layouts.app')
@section('title.page'){{$getQuest->title}}@endsection
@section('content.page')
    <form action="{{route('question.store',[$getQuest->testing_id, $getQuest->id])}}" method="post">
        @csrf
        <div class="questions">
            <x-card.card-body>
                <x-form.label class="ms-1 ps-1 pb-0">
                    <h4><b>{{$getQuest->title}}</b></h4>
                </x-form.label>
            </x-card.card-body>
            <hr class="m-0 pb-1">
            @php($allAll = [])
            @if(strpos($getQuest->trueAnswers,','))
                @php($trueAnswers = explode(',',$getQuest->trueAnswers))
                @foreach($trueAnswers as $trueAn)
                    @php($allAll[] = $trueAn)
                @endforeach
            @else
                @php($trueAnswers = $getQuest->trueAnswers)
                @php($allAll[] = $getQuest->trueAnswers)
            @endif

            @if(strpos($getQuest->falseAnswers,','))
                @php($falseAnswers = explode(',',$getQuest->falseAnswers))
                @foreach($falseAnswers as $falseAn)
                    @php($allAll[] = $falseAn)
                @endforeach
            @else
                @php($allAll[] = $getQuest->falseAnswers)
            @endif
            @php(shuffle($allAll))
            <div class="ulQuest">
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
                    @foreach($allAll as $item)
                    <div class="checkLi">
                            @if(is_array($trueAnswers) && count($trueAnswers) > 1)
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
                </div>
            <x-form.input type="hidden" name="questId" value="{{$getQuest->id}}"/>
            <x-form.input type="hidden" name="testId" value="{{$getQuest->testing_id}}"/>
            <div class="d-flex justify-content-end w-100">
                <button type="button" name="getResult" class="btn btn-success p-1 m-1" id="getResult">{{__('Следующий вопрос')}}</button>
                <button type="submit" name="getQuestion" class="butHidden"></button>
            </div>
   </div>

</form>
    <script type="text/javascript">
        const buttonQuestion = document.getElementById('getResult')
        const nextQuestion = document.querySelector('.butHidden')
        const trueAnsDiv = document.querySelector('#trueAnsDiv')
        const falseAnsDiv = document.querySelector('#falseAnsDiv')
        const answers = document.querySelector('.answers')
        const keyAnswer = "trueAnswer"
        const checkFlag = "<?php Print($flag) ?>"
        let trueAnswers = '<?php if(gettype($trueAnswers) == "string"){Print($trueAnswers);}else{echo(json_encode($trueAnswers, JSON_UNESCAPED_UNICODE));} ?>'

        buttonQuestion.addEventListener('click', (event) => {
            if(checkFlag === "arr"){
                trueAnswers = JSON.parse(trueAnswers)
                let arrAll = []
                let av = document.getElementsByName("checkbox[]");
                for (e = 0; e < av.length; e++) {
                    if (av[e].checked === true) {
                        arrAll.push(av[e].value);
                    }
                }
                if(arrAll.sort().join(',')=== trueAnswers.sort().join(',')){
                    answers.style.display = 'block'
                    answers.style.background = '#badcba'
                    trueAnsDiv.style.display = 'block'
                }else{
                    answers.style.display = 'block'
                    answers.style.background = '#fad1d1'
                    falseAnsDiv.style.display = 'block'
                }
                setTimeout(() => {
                    nextQuestion.click()
                }, 5000)
            }else if(checkFlag === "str") {

                const checkRadio = document.querySelector('input[type=radio]:checked');
                if (String(checkRadio.id) === String(trueAnswers)) {
                    answers.style.display = 'block'
                    answers.style.background = '#badcba'
                    trueAnsDiv.style.display = 'block'
                } else {
                    answers.style.display = 'block'
                    answers.style.background = '#fad1d1'
                    falseAnsDiv.style.display = 'block'
                }
                setTimeout(() => {
                    nextQuestion.click()
                }, 5000)
            }
        });
    </script>
@endsection
