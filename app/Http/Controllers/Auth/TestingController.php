<?php
namespace App\Http\Controllers\Auth;

use App\Handler\AuthHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\All\ValidTestingRequest;
use App\Models\Category;
use App\Models\Question;
use App\Models\Testing;
use App\Models\User;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $testings = Testing::where('user_id',(int)$id)->orderBy('id','DESC')->get();
        if($testings != null){
            return view('auth.testing.index',compact('testings','id'));
        }else{
            return abort(404);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id,Request $request){
        $categories = Category::select(['id','name'])->orderBY('id','ASC')->get();
        if(isset($request)){
            return view('auth.testing.create',compact('request','categories','id'));
        }
        return view('auth.testing.create',compact('categories','id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id, ValidTestingRequest $request)
    {
        return AuthHandler::createTestingAuth($request,$id);
    }
    /**
     * Show the form for editing the specified resource
     */
    public function edit(string $id)
    {
        $categories = Category::select(['id','name'])->orderBY('id','ASC')->get();
        $testing = Testing::select(['id', 'name_test', 'content', 'passing_score', 'created_at', 'user_id'])->where('id', (int)$id)->first();
        if($testing == null) {return abort(404);}
        $questions = Question::where('testing_id', (int)$id)->get();
        if($questions == null) {return abort(404);}
        $count = Question::where('testing_id', (int)$id)->count('id');
        $userId = $testing->user_id;
        return view('auth.testing.edit',compact('testing','questions','count','userId','categories'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ValidTestingRequest $request, string $id){
        $result = $request->validated();
        $getUser = Testing::select(['user_id'])->where('id',$id)->first();
        if($getUser != null) {
            return AuthHandler::updateTestingAuth($result, $id, $getUser->user_id);
        }else{
            return abort(404);
        }
    }

    public function publicTesting($id, $active, $userId){
        AuthHandler::publicItem($id, $active,Testing::class);
        $id = $userId;
        return redirect()->route('auth.testing',['id'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    /*public function destroy(string $id)
    {
        Question::where('testing_id',$id)->delete();
        Testing::find((int)$id)->delete();
        return redirect()->route('admin.testing');
    }*/
}
