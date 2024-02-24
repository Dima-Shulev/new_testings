<?php
namespace App\Http\Controllers\Auth;

use App\Http\Requests\ValidEditRequest;
use App\Models\User;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index(){
        $id = User::select(['id','name'])->where('name',session('name'))->where('id',session('id'))->first();
        return view('auth.room.index',compact('id'));
    }

    public function editUser($id){
        $userData = User::find((int)$id);
        return view('auth.room.edit',compact('userData'));
    }

    public function update(ValidEditRequest $request,$id){
        return update_user_room($request,$id);
    }

    public function balance(){
        return view('auth.room.plug');
    }

    public function closeSession(){
         session()->flush();
         return redirect('/');
    }

}
