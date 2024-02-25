@extends('layouts.app')
@section('keywords.page'){{$show->keywords}}@endsection
@section('description.page'){{$show->description}}}}@endsection
@section('title.page'){{$show->title}}@endsection
@section('content.page')
    @if($show->url === "category")
        @php($allCategories = $category = \App\Models\Category::orderBy('id','ASC')->get())
        <x-category.all_categories :allCategories="$allCategories"/>
    @endif
    <div>
        @if(isset($searchTesting))
            @foreach($searchTesting as $item)
                <a href="{{route('question',$item->id)}}">{{$item->name_test}}</a>
            @endforeach
        @endif
    </div>
    <div>{{$show->content}}</div>
@endsection


