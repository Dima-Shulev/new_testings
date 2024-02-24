<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(){
        $articles = page_paginate(5,Article::class);
        return view('articles.index',compact('articles'));
    }

    public function show($url){
        $showArticles = Article::select(['id','title','category_id','content','active','url','user_id'])->where('url',$url)->orderBy('id','ASC')->get();
        $title = '';
        foreach($showArticles as $article){
            $title = $article->title;
        }
        return view('articles.show',compact('showArticles','title'));
    }
}
