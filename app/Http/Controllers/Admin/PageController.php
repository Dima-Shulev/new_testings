<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidatePageRequest;
use App\Models\Page;

class PageController extends Controller
{
   public function index(){
       $pages = page_paginate(5,Page::class);
       return view('admin.pages.index',compact('pages'));
   }

    public function create(){
        return view('admin.pages.create');
    }

    public function store(ValidatePageRequest $request){
        $result = $request->validated();
        return create_page($result);
    }

    public function edit($url){
        /*$modules = Module::select(['id','name','position','active'])->get();*/
        $pages = Page::where('url',$url)->first();
        return view('admin.pages.edit', compact('pages','url'));
    }

    public function update($id, ValidatePageRequest $request){
        $result = $request->validated();
        $result['checkPublic'] = checkPublic($request,$result);
        return update_page($result,$id);
    }

    public function publicPage($id,$active){
        public_item($id,$active,Page::class);
        return redirect()->route('admin.pages');
    }

    public function deletePage($id){
        Page::find((int)$id)->delete();
        return redirect()->route('admin.pages');
    }
}
