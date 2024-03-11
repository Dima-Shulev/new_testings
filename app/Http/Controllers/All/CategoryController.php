<?php
namespace App\Http\Controllers\All;

use App\Handler\AdminHandler;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Testing;

class CategoryController extends Controller
{
    public function index()
    {
        $allCategories = AdminHandler::pagePaginate(5,Category::class);
        return view('all.categories.index',compact('allCategories'));
    }

    public function show($url)
    {
        $category = Category::select(['id','name','content','url','metaKey','metaDescription'])->where('url',$url)->orderBy('id','ASC')->first();
        if($category != null) {
            $allTestings = Testing::where('categories_id', $category->id)->orderBy('id', 'ASC')->get();
            if ($allTestings) {
                if (isset($_GET['query'])) {
                    $response = $_GET['query'];
                    $response = strtolower(str_replace(" ", '', trim(htmlspecialchars($response))));
                    $searchTesting = Testing::where('name_test', 'like', "%{$response}%")->orWhere('content', 'like', "%{$response}%")->get();
                    if ($searchTesting) {
                        return view('all.categories.show', compact('category', 'allTestings', 'searchTesting'));
                    }
                }
                return view('all.categories.show', compact('category', 'allTestings'));
            } else {
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }
}
