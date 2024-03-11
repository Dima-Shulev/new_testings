@props(['searchTesting'=>$searchTesting])
<div {{$attributes}}>
    <h2>{{__('Результаты поиска')}}</h2>
    <hr>
    @if(count($searchTesting) > 0)
        @foreach($searchTesting as $item)
            <div class="mb-2 p-1">
                <a href="{{route('question',$item->id)}}">{{$item->name_test}}</a>
            </div>
        @endforeach
    @else
        <div class="mb-2 p-1">
            <p>{{__('Ничего не найдено')}}</p>
        </div>
    @endif
</div>
