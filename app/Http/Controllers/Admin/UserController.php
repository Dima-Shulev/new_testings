<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidUserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = page_paginate(5,User::class);
        return view('admin.user.index',compact('users'));
    }

    public function edit($id){
        $users = User::select(['id','name','email','status','password','created_at','balance','pay'])->where('id',(int)$id)->orderBy('created_at','desc')->first();
        return view('admin.user.edit', compact('users'));
    }

    public function update(ValidUserRequest $request, $id){
        $result = $request->validated();
        check_public_user($request,$result);
        return update_user($id,$result);
    }

    public function publicUser($id,$active){
        public_item($id,$active,User::class);
        return redirect()->route('admin.users');
    }

    public function delete($id){
        User::find($id)->delete();
        return redirect()->route('admin.users');
    }
}
