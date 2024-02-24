<?php

use App\Models\Review;
use App\Models\Template;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

if(! function_exists('active_link')){

    function active_link($name, $active = "active"){

        if(Route::is($name)){
            return $active;
        }else{
            $name = "";
            return $name;
        }
    }
}

if(! function_exists('random_code')){
    function random_code(){
        $string = '';
        for($i = 1; $i < 7; $i++){
            $item = rand(0,9);
            $string .= $item;
        }
        return $string;
    }
}

if(! function_exists('filter_block')){
    function filter_block($arr,$search,$category_id){
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
}

if(! function_exists('links')){
    function links($disk,$file){
        $path = '';
        if(empty($file)){
            $file = 'unknown.webp';
        }

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
}


if(! function_exists('session_user')){
    function session_user($user,$status,$link){
        $session = session();
        $session->put('session_user','session_auth');
        $session->put('session_status',$status);
        $session->put('id',$user->id);
        $session->put('status',$user->status);
        $session->put('name',$user->name);
        $session->put('email',$user->email);
        $session->put('balance',$user->balance);
        $session->put('avatar',$link);
        /*Auth::login($user);*/
    }
}

if(! function_exists('select_last')){
    function select_last($model,$one,$two,$three){
            return $model::select(["id","{$one}","{$two}","{$three}"])->orderBy('id','desc')->take(3)->get();
    }
}

if(! function_exists('page_paginate')){
    function page_paginate($limit,$model){
        $users = $model::query()->paginate($limit);
        return $users;
    }
}

if(! function_exists('url_translit')) {
    function url_translit($urlRus)
    {
        $converter = array(
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
            'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
            'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
            'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
            'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
            'э' => 'e', 'ю' => 'yu', 'я' => 'ya', ' ' => '-', '(' => '',
            ':' => '', ';' => '', '.' => '', ',' => '', '?' => '',
            '!' => '', '"' => '', '\'' => '', '`' => '',

            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
            'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
            'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
            'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch',
            'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
        );

        $value = strtr($urlRus, $converter);
        $result = strtolower($value);
        return $result;
    }
}

if(! function_exists('template')) {
        function template()
        {
            $template = Template::select(['id','name','active'])
                ->where('active', true)
                ->orderBy('id', 'ASC')
                ->first();
            if($template){
                if($template->name == 'Dark'){
                    $result = '/Template/css/dark.css';
                }else if($template->name == 'Light'){
                    $result = '/Template/css/light.css';
                }
                    return $result;
            }else{
                return false;
            }
        }
}

if(! function_exists('public_item')){
        function public_item($id,$active,$model){
                $public = $model::find($id);
                if ($active == 1) {
                    $public->active = 0;
                } else {
                    $public->active = 1;
                }
                $public->save();
        }
}

if(! function_exists('checkPublic')){
        function checkPublic($request,$result){
            if(!isset($request->checkPublic)){
                $result['checkPublic'] = false;
            }else if($request->checkPublic == "on"){
                $result['checkPublic'] = true;
            }
            return $result['checkPublic'];
        }
}

if(! function_exists('show_reviews')){
        function show_reviews($show,$model,$arr){
            $dateUser = $model::select('name', 'email', 'id')->where('id',$show->user_id)->first();
            $arr['id'] = $show->id;
            $arr['title'] = $show->title;
            $arr['like'] = $show->like;
            $arr['content'] = $show->content;
            $arr['created_at'] = $show->created_at;
            $arr['name'] = $dateUser->name;
            $arr['email'] = $dateUser->email;
            return $arr;
        }
}

if(! function_exists('like_review')) {
        function like_review($request,$post){
            if ($request->like) {
                $new_like = Review::find((int)$post);
                $new_like->like += 1;
                $new_like->save();
                return redirect()->route('reviews.show', ['post' => $post]);
            }
        }
}

if(! function_exists('show_one_review')) {
        function show_one_review($show,$url_like){
            if($show) {
                $arr = [];
                $arr = show_reviews($show,User::class,$arr);
                return view('reviews.show', compact('arr','url_like'));
            }
        }
}
