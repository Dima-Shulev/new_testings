<?php
namespace App\Handler;

use App\Mail\CreateTest;
use App\Mail\UpdateTest;
use App\Models\Category;
use App\Models\Question;
use App\Models\Testing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class AuthHandler extends ParentHandler
{
    public static function updateUserRoom($request, $id)
    {
        if ($request) {
            if (!empty($request->avatar)) {
                $image = Storage::disk('avatar')->putFile('', new File($request->avatar));
                $linkImage = asset("storage/avatar/{$image}");
            } else {
                $image = 'unknown.webp';
                $linkImage = asset("storage/avatar/{$image}");
            }
            $query = User::find((int)$id);
            $query->name = $request->name;
            $query->email = $request->email;
            $query->updated_at = date('Y-m-d H:i:s', time());
            $query->avatar = $image;
            $query->save();
            ParentHandler::sessionUser($query, 'session_user', $linkImage);
            return redirect()->route('auth.room')->with('success', 'update_user');
        } else {
            return redirect()->route('auth.room.edit')->with('error', 'error_user');
        }
    }

    public static function createTestingAuth($request, $id){
        $checkPay = User::select(['id','pay','email'])->where('id',$id)->first();
        $countTests = Testing::where('user_id',$id)->count('id');
        $category = Category::select(['id','name'])->where('id',$request['category'])->first();
        $count = count($request["questions"]);
        if(!isset($request['created_at']) || $request['created_at'] == null) $request['created_at'] = date("Y-m-d H:i:s");
        if(!isset($request['passing_score']) || $request['passing_score'] == null) $request['passing_score'] =  "50";
        if(!isset($request['metaDescription']) || $request['metaDescription'] == null) $request['metaDescription'] =  "null";
        if(!isset($request['metaKey']) || $request['metaKey'] == null) $request['metaKey'] =  "null";
        $show_answers = !isset($request['show_answers'])?"off":$request['show_answers'];
        $time = !isset($request['time']) || $request['time'] == null ? 0 : $request['time'];

        if(($checkPay->pay === "no" && $countTests < 10) || ($checkPay->pay === "yes")) {
            $test_id = Testing::create([
                'name_test' => (string)$request["name_test"],
                'content' => (string)$request["name_test"],
                'passing_score' => (string)$request['passing_score'],
                'metaDescription' => (string)$request['metaDescription'],
                'metaKey' => (string)$request['metaKey'],
                'created_at' => (string)$request['created_at'],
                'active' => 1,
                'show_answers' => $show_answers,
                'time' => $time,
                'user_id' => $id,
                'categories_id' => $request['category']
            ]);

            for ($i = 0; $i < $count; $i++) {
                Question::create([
                    'title' => $request['questions'][$i],
                    'trueAnswers' => $request['trueAnswers'][$i],
                    'falseAnswers' => $request['falseAnswers'][$i],
                    'allAnswers' => $request['trueAnswers'][$i] . "," . $request['falseAnswers'][$i],
                    'description' => $request['description'][$i],
                    'metaKey' => $request['questions'][$i],
                    'metaDescription' => $request['questions'][$i],
                    'testing_id' => $test_id->id
                ]);
            }
            Mail::to("shulev-dmitriy@yandex.ru")->send(new CreateTest((int)$id,(string)$checkPay->email,(string)$category->name,(string)$request["name_test"],$count));
            return redirect()->route('auth.testing', $id)->with('success', 'create_testing');
        }else{
            return redirect()->route('auth.testing', $id)->with('error', 'error_limit_create_testing');
        }
    }

    public static function updateTestingAuth($result, $id, $user_id)
    {
        $user = User::select(['email'])->where('id',(int)$user_id)->first();
        $count = Question::where('testing_id',(int)$id)->count('id');
        $idQuest = Question::select('id')->where('testing_id',(int)$id)->orderBy('id','ASC')->get();
        $category = Category::select(['id','name'])->where('id',$result['category'])->first();
        $show_answers = !isset($result['show_answers'])?"off":$result['show_answers'];
        $time = !isset($result['time']) || $result['time'] == null ? 0 : $result['time'];
        if($result['category'] === "-/-" ){
            return redirect()->route('auth.testing.edit',['id'=>$id])->with('error', 'error_update_testing_category');
        }
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
            $update->categories_id = (int)$result['category'];
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
            Mail::to("shulev-dmitriy@yandex.ru")->send(new UpdateTest((int)$user_id,(string)$user->email,(string)$category->name,(string)$result['name_test'],$count));
            return redirect()->route('auth.testing',['id'=>$user_id])->with('success', 'update_testing');
        } else {
            return redirect()->route('auth.testing.edit',['id'=>$id])->with('error', 'error_update_testing');
        }
    }

    public static function warningTest($id){
        $check = User::select(['id','pay'])->where('id',$id)->first();
        return $check->pay;
    }
}
