<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidTesting;
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
        $testings = page_paginate(5,Testing::class);;
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
    public function store(ValidTesting $request)
    {
        return create_testing($request);
    }
    /**
     * Show the form for editing the specified resource
     */
    public function edit(string $id)
    {
        $testing = Testing::select(['id', 'name_test', 'content', 'passing_score', 'created_at', 'user_id'])->where('id', (int)$id)->first();
        $questions = Question::where('testing_id', (int)$id)->get();
        $count = Question::where('testing_id', (int)$id)->count('id');
        return view('admin.testing.edit',compact('testing','questions','count'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ValidTesting $request, string $id)
    {
        $result = $request->validated();
        return update_testing($result, $id);
    }


    public function publicTesting($id, $active){
        public_item($id, $active,Testing::class);
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
