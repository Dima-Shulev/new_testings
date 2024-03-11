@extends('layouts.app')
@section('keywords.page'){{$show->metaKey}}@endsection
@section('description.page'){{$show->metaDescription}}@endsection
@section('title.page'){{$show->name}}@endsection
@section('content.page')
   @php($searchTesting = isset($searchTesting) && $searchTesting != [] ? $searchTesting: null)
   @if($show->url === "category")
       @php($allCategories = $category = \App\Models\Category::orderBy('id','ASC')->get())
       @if($searchTesting != null)
          <x-search class="LC mt-5 p-1" :searchTesting="$searchTesting" />
       @endif
       <div class="border-bottom pb-3 mt-5">
           <div class="d-flex flex-column justify-content-start">
               <h1 class="h2">{{$show->name}}</h1>
               <hr>
               <div>{{$show->content}}</div>
           </div>
       </div>
       <x-category.all_categories :allCategories="$allCategories"/>
   @else
       @if($searchTesting != null)
            <x-search class="LC mt-5 p-1" :searchTesting="$searchTesting" />
       @endif
       <div class="border-bottom pb-3 mt-5">
           <div class="d-flex flex-column justify-content-start">
               <h1 class="h2">{{$show->name}}</h1>
               <hr>
               <div>{{$show->content}}</div>
           </div>
       </div>
@endif
@endsection


