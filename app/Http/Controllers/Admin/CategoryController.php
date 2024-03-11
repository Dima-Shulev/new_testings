<?php
namespace App\Http\Controllers\Admin;

use App\Handler\AdminHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidateCategory;
use App\Models\Question;
use App\Models\Category;
use App\Models\Testing;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = AdminHandler::pagePaginate(5,Category::class);
        return view('admin.categories.index',compact('categories'));
    }

    public function show($url){
        $category = Category::select(['id','name','content'])->where('url',$url)->orderBy('id','ASC')->first();
        $allTestings = Testing::where('category_id',$category->id)->orderBy('id','ASC')->get();
        return view('admin.categories.show',compact('category','allTestings'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(ValidateCategory $request){
        $result = $request->validated();
        return AdminHandler::createCategory($result);
    }

    public function edit($url){
        $categories = Category::select(['id','name','content','created_at','metaKey','metaDescription','active','user_id','url'])->where('url',$url)->first();
        return view('admin.categories.edit', compact('categories','url'));
    }

    public function update($id, ValidateCategory $request){
        $result = $request->validated();
        $result['checkPublic'] = checkPublic($request,$result);
        return AdminHandler::updateCategory($result,$id);
    }

    public function publicCategory($id,$active){
        public_item($id,$active,Category::class);
        return redirect()->route('admin.categories');
    }

    public function deleteCategory($id){
        Category::find((int)$id)->delete();
        return redirect()->route('admin.categories');
    }
}
