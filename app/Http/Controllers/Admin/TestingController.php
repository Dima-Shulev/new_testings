<?php
namespace App\Http\Controllers\Admin;

use App\Handler\AdminHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\All\ValidTestingRequest;
use App\Models\Category;
use App\Models\Question;
use App\Models\Testing;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testings = AdminHandler::pagePaginate(5,Testing::class);;
        return view('admin.testing.index',compact('testings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $categories = Category::select(['id','name'])->orderBY('id','ASC')->get();
        if(isset($request)){
            return view('admin.testing.create',compact('request','categories'));
        }
        return view('admin.testing.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidTestingRequest $request)
    {
        return AdminHandler::createTesting($request);
    }
    /**
     * Show the form for editing the specified resource
     */
    public function edit(string $id)
    {
        $categories = Category::select(['id','name'])->orderBY('id','ASC')->get();
        $testing = Testing::select(['id', 'name_test', 'content', 'passing_score', 'created_at', 'user_id','show_answers','time'])->where('id', (int)$id)->first();
        if($testing == null) {return abort(404);}
        $questions = Question::where('testing_id', (int)$id)->get();
        if($questions == null) {return abort(404);}
        $count = Question::where('testing_id', (int)$id)->count('id');
        return view('admin.testing.edit',compact('testing','questions','count','categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ValidTestingRequest $request, string $id)
    {
        $result = $request->validated();
        return AdminHandler::updateTesting($result, $id);
    }


    public function publicTesting($id, $active){
        AdminHandler::publicItem($id, $active,Testing::class);
        return redirect()->route('admin.testing');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Question::where('testing_id',$id)->delete();
        Testing::find((int)$id)->delete();
        return redirect()->route('admin.testing');
    }
}
