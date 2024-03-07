<?php
namespace App\Http\Controllers\Auth;

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
        return view('auth.testing.index',compact('testings','id'));
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
        return create_testing($request,$id);
    }
    /**
     * Show the form for editing the specified resource
     */
    public function edit(string $id)
    {
        $testing = Testing::select(['id', 'name_test', 'content', 'passing_score', 'created_at', 'user_id'])->where('id', (int)$id)->first();
        $questions = Question::where('testing_id', (int)$id)->get();
        $count = Question::where('testing_id', (int)$id)->count('id');
        $userId = $testing->user_id;
        return view('auth.testing.edit',compact('testing','questions','count','userId'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ValidTestingRequest $request, string $id){
        $result = $request->validated();
        $getUser = Testing::select(['user_id'])->where('id',$id)->first();
        return update_testing_auth($result, $id, $getUser->user_id);
    }


    public function publicTesting($id, $active, $userId){
        public_item($id, $active,Testing::class);
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
