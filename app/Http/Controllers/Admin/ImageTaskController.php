<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageTaskController extends Controller
{
    public function uploadImage(Request $request){
        $imgpath = request()->file('file')->store('images', 'public');
        return response()->json(['location'=> "/storage/$imgpath"]);
    }
}
