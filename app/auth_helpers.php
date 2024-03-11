<?php

use App\Models\Question;
/*use App\Models\Review;*/
use App\Models\Testing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

/*if(! function_exists('create_review')){
    function create_review($checkUser,$result){
        if($checkUser){
            Review::query()->create([
                'title' => $result['title'],
                'content' => $result['content'],
                'user_id' => $checkUser->id,
                'created_at' => date('Y-m-d H:i:s'),
                'status' => true,
            ]);
        }
    }
}*/

if(! function_exists('update_user_room')){
    function update_user_room($request,$id){

        if($request){
            if(!empty($request->avatar)){
                $image = Storage::disk('avatar')->putFile('',new File($request->avatar));

                $linkImage = asset("storage/avatar/{$image}");
            }else{
                $image ='unknown.webp';
                $linkImage = asset("storage/avatar/{$image}");
            }
            $query = User::find((int)$id);
            $query->name = $request->name;
            $query->email = $request->email;
            $query->updated_at = date('Y-m-d H:i:s',time());
            $query->avatar = $image;
            $query->save();

            session_user($query, 'session_user',$linkImage);
            return redirect()->route('auth.room')->with('success','update_user');
        }else{
            return redirect()->route('auth.room.edit')->with('error','error_user');
        }
    }
}

if(! function_exists('all_answers')){
    function all_answers($trueAnswers,$falseAnswers){

        $allAll = [];
            if(strpos($trueAnswers,',')) {
                $allTrue = explode(',', $trueAnswers);
                foreach ($allTrue as $trueAn) {
                    $allAll[] = $trueAn;
                }
            }else {
                $allTrue = $trueAnswers;
                $allAll[] = $trueAnswers;
            }
            if(strpos($falseAnswers,',')) {
                $falseAnswers = explode(',', $falseAnswers);
                foreach ($falseAnswers as $falseAn) {
                    $allAll[] = $falseAn;
                }
            }else {
                $allAll[] = $falseAnswers;
            }
            shuffle($allAll);
            return [$allAll, $allTrue];
    }
}

if(! function_exists('answers_md5')){
    function answers_md5($trueAnswers){
        if(is_array($trueAnswers)){
            foreach($trueAnswers as $item){
                $item = md5($item);
            }
        }else if(is_string($trueAnswers)){
            $trueAnswers = md5($trueAnswers);
        }
        return $trueAnswers;
    }
}

if(! function_exists('update_testing_auth')) {
    function update_testing_auth($result, $id, $user_id){
        $count = Question::where('testing_id',(int)$id)->count('id');
        $idQuest = Question::select('id')->where('testing_id',(int)$id)->orderBy('id','ASC')->get();
        $show_answers = !isset($result['show_answers'])?"off":$result['show_answers'];
        $time = !isset($result['time']) || $result['time'] == null ? 0 : $result['time'];

        if ($result) {
            $update = Testing::find((int)$id);
            $update->name_test = $result['name_test'];
            $update->content = $result['content'];
            $update->passing_score = $result['passing_score'];
            $update->active = 0;
            $update->time = $time;
            $update->show_answers = $show_answers;
            $update->created_at = new Carbon($result['created_at']);
            $update->user_id = $user_id;
            $update->save();

            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin', 'session_auth');
            $session->put('name', $result['name_test']);

            for ($i = 0; $i < $count; $i++) {
                Question::where('title', $result['questions'][$i])->orWhere('id', $idQuest[$i]->id)->update([
                    'title' => $result['questions'][$i],
                    'trueAnswers' => $result['trueAnswers'][$i],
                    'falseAnswers' => $result['falseAnswers'][$i],
                    'allAnswers' => $result['trueAnswers'][$i] . "," . $result['falseAnswers'][$i],
                    'description' => $result['description'][$i],
                    'testing_id' => $id
                ]);
            }
            return redirect()->route('auth.testing',['id'=>$user_id])->with('success', 'update_testing');
        } else {
            return redirect()->route('auth.testing.edit')->with('error', 'error_update_testing');
        }
    }
}



