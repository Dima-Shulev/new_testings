<?php
namespace App\Http\Controllers\Auth;

use App\Handler\AuthHandler;
use App\Http\Requests\Auth\ValidEditRequest;
use App\Models\User;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index(){
        $id = User::select(['id','name'])->where('id',session('id'))->first();
        return view('auth.room.index',compact('id'));
    }

    public function editUser($id){
        $userData = User::find((int)$id);
        return view('auth.room.edit',compact('userData'));
    }

    public function update(ValidEditRequest $request,$id){
        return AuthHandler::updateUserRoom($request,$id);
    }

    public function balance(){
        return view('auth.room.plug');
    }

    public function closeSession(){
         session()->flush();
         return redirect('/');
    }
}
