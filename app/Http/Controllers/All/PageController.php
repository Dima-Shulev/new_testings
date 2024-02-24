<?php
namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;

class PageController extends Controller
{
    public function index(){
        $home = Page::where('home','on')->first();
        return view('all.index',compact('home'));
    }

    public function show($url){
        $checkUrl = Page::select(['url'])->where('url',$url)->orderBy('id','ASC')->first();
        if($checkUrl != null) {
            $show = Page::select(['id','name','content','metaKey','metaDescription','url'])->where('url', $url)->orderBy('id', 'ASC')->first();
            return view('all.show', compact('show'));
        }else if($url == "login"){
            return view('all.login.index');
        }else if($url == "register") {
            return view('all.register.index');
        }else if($url == "admin") {
            return view('admin.admin');
        }else{
           abort(404);
        }
    }
}
