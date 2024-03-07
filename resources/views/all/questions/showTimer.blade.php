<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dates = new Date()
        const deadline = new Date(dates.getFullYear(), dates.getMonth(),dates.getDate(), <?php echo (int)$hour ?>,<?php echo (int)$minute ?>,<?php echo (int)$second ?>)
        let timerId = null
        function declensionNum(num, words) {
            return words[(num % 100 > 4 && num % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][(num % 10 < 5) ? num % 10 : 5]];
        }
        function countdownTimer() {
            const diff = deadline - new Date();
            if (diff <= 0) {
                clearInterval(timerId);
                location.href="//testing.loc:8888/testing/" + <?php echo $getQuest->testing_id ?> + "/result/" + <?php echo $count ?>
            }
            const hours = diff > 0 ? Math.floor(diff / 1000 / 60 / 60) % 24 : 0;
            const minutes = diff > 0 ? Math.floor(diff / 1000 / 60) % 60 : 0;
            const seconds = diff > 0 ? Math.floor(diff / 1000) % 60 : 0;
            $hours.textContent = hours < 10 ? '0' + hours : hours;
            $minutes.textContent = minutes < 10 ? '0' + minutes : minutes;
            $seconds.textContent = seconds < 10 ? '0' + seconds : seconds;
            $hours.dataset.title = declensionNum(hours, ['час', 'часа', 'часов']);
            $minutes.dataset.title = declensionNum(minutes, ['минута', 'минуты', 'минут']);
            $seconds.dataset.title = declensionNum(seconds, ['секунда', 'секунды', 'секунд']);
        }
        const $hours = document.querySelector('.timer__hours');
        const $minutes = document.querySelector('.timer__minutes');
        const $seconds = document.querySelector('.timer__seconds');
        countdownTimer();
        timerId = setInterval(countdownTimer, 1000);
    });
</script>

@extends('layouts.app')
@section('title.page'){{$getQuest->title}}@endsection
@section('content.page')
    @php($answers = all_answers($getQuest->trueAnswers,$getQuest->falseAnswers))
    @php($show_answers = show_answers($getQuest->testing_id))
    <div class="timer">
        <div class="timer__items">
            <div class="timer__item timer__hours">00</div>
            <div class="timer__item timer__minutes">00</div>
            <div class="timer__item timer__seconds">00</div>
        </div>
    </div>
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
            <x-form.input type="hidden" name="hour" value="{{$hour}}"/>
            <x-form.input type="hidden" name="minute" value="{{$minute}}"/>
            <x-form.input type="hidden" name="second" value="{{$second}}"/>
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
