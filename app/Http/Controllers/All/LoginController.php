<?php
namespace App\Http\Controllers\All;

use App\Handler\AllHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\All\ValidateCheckMailRequest;
use App\Http\Requests\All\ValidateEntranceRequest;
use App\Models\User;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function index(){
        return view('all.login.index');
    }

    public function store(ValidateEntranceRequest $request)
    {
        $login = User::select('id', 'name', 'email', 'password', 'active', 'balance', 'status','avatar')->where('email', '=', $request->input('email'))->orderBy('id', 'ASC')->first();
        return AllHandler::userEntrance($login,$request);
    }

    public function forget(){
        return view('all.login.forget');
    }

    public function checkMail(ValidateCheckMailRequest $request){
        $validate = $request->validated();
        $check = User::select('email','id')->where('email', $validate['email'])->orderBy('id','ASC')->first();
        return AllHandler::sendMail($check,$validate);
    }

    public function check(){
        return view('all.login.check');
    }

    public function checkCode(Request $request)
    {
        return AllHandler::checkCode($request);
    }

    public function change($id){
        return view('all.login.change',compact('id'));
    }

    public function changePass(Request $request){
        $change = User::find((int)$request->id);
        return AllHandler::changePass($change,$request);
    }

    /*public function closeSession(){
        session()->forget('session_user');
        return redirect('/');
    }*/
}
