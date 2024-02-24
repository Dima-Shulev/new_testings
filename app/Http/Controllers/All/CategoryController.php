<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Testing;

class CategoryController extends Controller
{
    public function index(){
        $allCategories = Category::query()->paginate(5);
        return view('all.categories.index',compact('allCategories'));
    }

    public function show($url){
        $category = Category::select(['id','name','content','url'])->where('url',$url)->orderBy('id','ASC')->first();
        $allTestings = Testing::where('categories_id',$category->id)->orderBy('id','ASC')->get();
        return view('all.categories.show',compact('category','allTestings'));
    }
}
