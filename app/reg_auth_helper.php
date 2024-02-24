<?php

use App\Mail\MailerClient;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

if(! function_exists('register')){
    function register($request){

        if(!empty($request->avatar)){
            $path = Storage::disk('avatar')->putFile('',new File($request->avatar));
            $linkImage = asset("storage/avatar/{$path}");
        }else{
            $path = 'unknown.webp';
            $linkImage = asset("storage/avatar/{$path}");
        }

        $createUser = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'active' => true,
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
            //return redirect()->route('home')->with('success', 'register');
        }
            event(new Registered($createUser));
            return redirect()->route('verification.notice');
    }

    if(! function_exists('user_entrance')){
        function user_entrance($login,$request){
            if ($login) {
                if ($login->active == true) {
                    if ($login->status === 'user') {
                        if (Hash::check($request->input('password'), $login->password)) {
                            $linkAvatar = asset("storage/avatar/{$login->avatar}");
                            session_user($login, 'session_user',$linkAvatar);
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
    }

    if(! function_exists('check_code')){
        function check_code($request){
            if (Hash::check($request->code, $request->check)) {
                return redirect()->route('login.change',['id'=> $request->id]);
            } else {
                return redirect()->route('login.check')->with('error','error_check_code');
            }
        }
    }

    if(! function_exists('change_pass')){
        function change_pass($change,$request){
            $change->password = Hash::make($request->new_pass);
            $change->save();
            return redirect()->route('login')->with('success','success_update_pass');
        }
    }

    if(! function_exists('send_mail')){
        function send_mail($check,$validate){
            if($check){
                $id = (string)$check->id;
                $check_code = random_code();
                $gen = Hash::make($check_code);
                Mail::to($validate['email'])->send(new MailerClient($validate['email'],$check_code));
                return view('login.check',compact('gen','id'));
            }else{
                return redirect()->route('login.forget')->with('error','error_email');
            }
        }
    }
}
