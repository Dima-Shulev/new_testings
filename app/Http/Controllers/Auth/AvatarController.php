<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function uploadAvatar(Request $request){
        $imgpath = request()->file('file')->store('avatar', 'public');
        return response()->json(['location'=> "/storage/avatar/$imgpath"]);
    }
}
