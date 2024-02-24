@props(['num'=>$num,'questions'=>$questions])
<div class="bg-secondary-subtle h-50 m-2 p-2">
<x-card.card-body>
    <x-form.label class="m-1 p-1">
        <h4>{{__("Вопрос: $num")}}</h4>
    </x-form.label>
    <hr>
    <x-form.input type="text" name="questions[]" class="m-1 w-75" placeholder="Текст вопроса" value="{{$questions->title}}"/>
</x-card.card-body>

<x-card.card-body>
    <x-form.label class="m-1 p-1">
        <b>{{__('Правильный ответ(или ответы через запятую):')}}</b>
    </x-form.label>
    <x-form.input type="text" name="trueAnswers[]" class="m-1 w-75" placeholder="правильный" value="{{$questions->trueAnswers}}"/>
</x-card.card-body>

<x-card.card-body>
    <x-form.label class="m-1 p-1">
        <b>{{__('Не правильные ответы(через запятую):')}}</b>
    </x-form.label>
    <x-form.input type="text" name="falseAnswers[]" class="m-1 w-75" placeholder="не правильный" value="{{$questions->falseAnswers}}"/>
</x-card.card-body>

<x-card.card-body>
    <x-form.label class="m-1 p-1">
       <b>{{__('Описание:')}}</b>
    </x-form.label>
    <x-form.input type="text" name="description[]" class="m-1 w-75" placeholder="описание" value="{{$questions->description}}"/>
</x-card.card-body>
</div>
