<?php
namespace App\Handler;

use App\Models\Question;
use App\Models\Testing;
use Exception;

class ParentHandler
{
    public static function urlTranslit($urlRus){
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

    public static function publicItem($id,$active,$model){
        $public = $model::find($id);
        if ($active == 1) {
            $public->active = 0;
        } else {
            $public->active = 1;
        }
        $public->save();
    }

    public static function checkPublic($request,$result){
        if(!isset($request->checkPublic)){
            $result['checkPublic'] = false;
        }else if($request->checkPublic == "on"){
            $result['checkPublic'] = true;
        }
        return $result['checkPublic'];
    }

    public static function sessionUser($user,$status,$link){
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

        public static function pagePaginate($limit,$model){
        $users = $model::query()->paginate($limit);
        return $users;
    }

    public static function selectLast($model,$one,$two,$three){
        return $model::select(["id","{$one}","{$two}","{$three}"])->orderBy('id','desc')->take(3)->get();
    }

    public static function checkPublicUser($request,$result){
        if(!isset($request->checkPublic)){
            $result['checkPublic'] = false;
        }else if($request->checkPublic == "on"){
            $result['checkPublic'] = true;
        }
        return $result['checkPublic'];
    }
}
