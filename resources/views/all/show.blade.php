@extends('layouts.app')
@section('keywords.page'){{$show->keywords}}@endsection
@section('description.page'){{$show->description}}}}@endsection
@section('title.page'){{$show->title}}@endsection
@section('content.page')
    @if($show->url === "category")
        @php($allCategories = $category = \App\Models\Category::orderBy('id','ASC')->get())
        <x-category.all_categories :allCategories="$allCategories"/>
    @endif
        @if(isset($searchTesting))
            <div class="LC m-1 p-1">
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
        @endif
    <div>{{$show->content}}</div>
@endsection


