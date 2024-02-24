<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateArticle;
use App\Models\Article;
use App\Models\Category;
use App\Models\Module;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request){
        $articles = page_paginate(5,Article::class);
        return view('admin.articles.index',compact('articles'));
    }

    public function create(){
        $modules = Module::select(['id','name','position','active'])->get();
        $selectCategory = Category::select(['id','name'])->get();
        return view('admin.articles.create',compact('selectCategory','modules'));
    }

    public function store(ValidateArticle $request){

        $result = $request->validated();
        $result['checkPublic'] = checkPublic($request,$result);
        return create_article($result);
    }

    public function edit($url){
        $modules = Module::select(['id','name','position','active'])->get();
        $selectCategory = Category::select(['id','name'])->get();
        $articles = Article::select(['id','title','content','created_at','metaKey','metaDescription','active','user_id','category_id','url'])->where('url',$url)->first();
        return view('admin.articles.edit', compact('articles','url','selectCategory','modules'));
    }

    public function update($id, ValidateArticle $request){
        $result = $request->validated();
        $result['checkPublic'] = checkPublic($request,$result);
        return update_article($result,$id);
    }

    public function publicArticle($id,$active){
        public_item($id,$active,Article::class);
        return redirect()->route('admin.articles');
    }

    public function deleteArticle($id){
        Article::find((int)$id)->delete();
        return redirect()->route('admin.articles');
    }
}
