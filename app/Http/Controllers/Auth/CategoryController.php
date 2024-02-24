<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $allCategories = Category::query()->paginate(5);
        return view('categories.index', compact('allCategories'));
    }

    public function show($url)
    {
        $category = Category::select(['id', 'name', 'content'])->where('url', $url)->orderBy('id', 'ASC')->first();
        $allArticles = Article::select(['id', 'title', 'category_id', 'content', 'active', 'url'])->where('category_id', $category->id)->orderBy('id', 'ASC')->get();
        return view('categories.show', compact('category', 'allArticles'));
    }
}
