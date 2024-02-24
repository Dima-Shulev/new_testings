@if($allCategories->isEmpty())
    <p>{{__('Нет ни одной созданной категории')}}</p>
@else
    <div class="row">
        @foreach($allCategories as $category)
                    <a href="{{route('categories.show',['url'=>$category->url])}}">
                            <h2 class="h4">{{$category->name}}</h2>
                    </a>
        @endforeach
    </div>
@endif
