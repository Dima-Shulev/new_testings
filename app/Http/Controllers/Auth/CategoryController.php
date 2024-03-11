<?php
namespace App\Http\Controllers\Auth;

use App\Handler\AuthHandler;
use App\Http\Controllers\Controller;
/*use App\Models\Article;*/
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $allCategories = AuthHandler::pagePaginate(5,Category::class);
        return view('categories.index', compact('allCategories'));
    }

   /* public function show($url)
    {
        $category = Category::select(['id', 'name', 'content'])->where('url', $url)->orderBy('id', 'ASC')->first();
        $allArticles = Article::select(['id', 'title', 'category_id', 'content', 'active', 'url'])->where('category_id', $category->id)->orderBy('id', 'ASC')->get();
        return view('categories.show', compact('category', 'allArticles'));
    }*/
}
