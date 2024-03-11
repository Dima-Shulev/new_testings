<?php
namespace App\Http\Controllers\All;

use App\Handler\AllHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\All\ValidateRegisterRequest;

class RegisterController extends Controller
{
    public function index(){
        return view('register.index');
    }

    public function store(ValidateRegisterRequest $request){
        return AllHandler::register($request);
    }
}
