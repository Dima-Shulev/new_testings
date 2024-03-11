<?php
namespace App\Handler;

use App\Mail\MailerClient;
use App\Models\Testing;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class AllHandler extends ParentHandler
{
    public static function activeLink($name, $active = "active")
    {
        if(Route::is($name)) {
            return $active;
        }else {
            $name = "";
        }
        return $name;
    }

    public static function randomCode()
    {
        $string = '';
        for($i = 1; $i < 7; $i++){
            $item = rand(0,9);
            $string .= $item;
        }
        return $string;
    }

    public static function filterBlock($arr,$search,$category_id)
    {
        $arr = array_filter($arr, function($item) use($search, $category_id) {
            if($search && !str_contains(strtolower($item->title), strtolower($search))){
                return false;
            }
            if($category_id && $item->category_id != $category_id){
                return false;
            }
            return true;
        });
    }

    public static function links($disk,$file){
        $path = '';
        if(empty($file)){ $file = 'unknown.webp'; }
        Storage::disk($disk)->get($file);
        if($disk == 'public'){
            $path = 'storage';
        }else if($disk == 'avatar'){
            $path = 'storage/avatar';
        }else{
            $path = 'storage';
        }
        $link = asset("{$path}/{$file}");
        return $link;
    }

    public static function allAnswers($trueAnswers, $falseAnswers)
    {
        $allAll = [];
        if (strpos($trueAnswers, ',')) {
            $allTrue = explode(',', $trueAnswers);
            foreach ($allTrue as $trueAn) {
                $allAll[] = $trueAn;
            }
        } else {
            $allTrue = $trueAnswers;
            $allAll[] = $trueAnswers;
        }
        if (strpos($falseAnswers, ',')) {
            $falseAnswers = explode(',', $falseAnswers);
            foreach ($falseAnswers as $falseAn) {
                $allAll[] = $falseAn;
            }
        } else {
            $allAll[] = $falseAnswers;
        }
        shuffle($allAll);
        return [$allAll, $allTrue];
    }


    public static function answersMD5($trueAnswers)
    {
        if(is_array($trueAnswers)){
            foreach($trueAnswers as $item){
                $item = md5($item);
            }
        }else if(is_string($trueAnswers)){
            $trueAnswers = md5($trueAnswers);
        }
        return $trueAnswers;
    }

    public static function showAnswers($test_id)
    {
        $show = Testing::select(['id','show_answers'])->where('id',$test_id)->first();
        if($show->show_answers === "on"){
            $show_answers = true;
        }else{
            $show_answers = false;
        }
        return $show_answers;
    }

    public static function register($request)
    {

        if(!empty($request->avatar)){
            $path = Storage::disk('avatar')->putFile('',new File($request->avatar));
            $linkImage = asset("avatar/{$path}");
        }else{
            $path = 'unknown.webp';
            $linkImage = asset("avatar/{$path}");
        }

        $createUser = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'active' => 1,
            'pay'=> 'no',
            'status' => 'user',
            'avatar'=> $path,
            'created_at'=> date('Y-m-d H:i:s'),
        ]);

        if($createUser){
            $user = User::select(['id','name','email','active','status','avatar','balance','created_at'])
                        ->where('email',$request->email)
                        ->first();
            Auth::login($createUser);
            session_user($user,'session_user',$linkImage);
            }
            event(new Registered($createUser));
            return redirect()->route('verification.notice');
    }

    public static function userEntrance($login,$request)
    {
        if ($login) {
            if ($login->active == true) {
                if ($login->status === 'user') {
                    if (Hash::check($request->input('password'), $login->password)) {
                        $linkAvatar = asset("avatar/{$login->avatar}");
                        AuthHandler::sessionUser($login, 'session_user',$linkAvatar);
                        Auth::login($login);
                        return redirect()->route('auth.room')->with('success', 'entrance');
                    } else {
                        return redirect()->route('login')->with('error', 'error_pass');
                    }

                }else if($login->status === 'admin'){
                    return redirect()->route('admin');
                }

            } else {
                return redirect()->route('login')->with('error', 'error_active');
            }

        } else {
            return redirect()->route('login')->with('error', 'error_email');
        }
    }

    public static function checkCode($request)
    {
        if (Hash::check($request->code, $request->check)) {
            return redirect()->route('login.change',['id'=> $request->id]);
        } else {
            return redirect()->route('login.check')->with('error','error_check_code');
        }
    }

    public static function changePass($change,$request)
    {
        $change->password = Hash::make($request->new_pass);
        $change->save();
        return redirect()->route('login')->with('success','success_update_pass');
    }

    public static function sendMail($check,$validate){
        if($check){
            $id = (string)$check->id;
            $check_code = AllHandler::randomCode();
            $gen = Hash::make($check_code);
            Mail::to($validate['email'])->send(new MailerClient($validate['email'],$check_code));
            return view('login.check',compact('gen','id'));
        }else{
            return redirect()->route('login.forget')->with('error','error_email');
        }
    }
}
