<?php
namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Testing;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
        public function index($id){
            $count = Question::where('testing_id',$id)->count('id');
            $time = Testing::select(['id','time'])->where('id',$id)->first();
            $time = $time->time > 0 ? $time->time : "none";
            $allQuestionsTest = Question::select(['id','title','testing_id'])->where('testing_id',$id)->get();
            if($time !== "none"){
                date_default_timezone_set('Europe/Moscow');
                $time = date("H:i:s ",strtotime("+{$time} minutes"));
                $time = explode(":",$time);
                $hour = $time[0];
                $minute = $time[1];
                $second = $time[2];
                return view('all.questions.index',compact('allQuestionsTest','count','hour','minute','second','id'));
            }else{
                return view('all.questions.index',compact('allQuestionsTest','count','id'));
            }
        }

        public function show($id, $questId)
        {
            $count = Question::where("testing_id",(int)$id)->count('id');
            $getQuest = Question::where("testing_id",(int)$id)->where('id', $questId)->first();
                return view('all.questions.show', compact('getQuest','count'));
        }

        public function showTimer($id, $questId, $hour, $minute, $second)
        {
            $count = Question::where("testing_id",(int)$id)->count('id');
            $getQuest = Question::where("testing_id",(int)$id)->where('id', $questId)->first();
                return view('all.questions.showTimer', compact('getQuest','hour', 'minute', 'second', 'count'));
        }

        public function store(Request $request){
            $hour = isset($request['hour'])?$request['hour']:null;
            $minute = isset($request['minute'])?$request['minute']:null;
            $second = isset($request['second'])?$request['second']:null;

            $getQuest = Question::where("testing_id",(int)$request->id)->where('id',$request->questId)->orderBy('id','ASC')->first();
            $end = Question::where("testing_id",(int)$request->id)->orderBy('id','DESC')->first();
            $count = Question::where("testing_id",(int)$request->id)->count('id');
            if(isset($request->radio) && (string)$getQuest->trueAnswers === (string)$request->radio){
                session()->increment('result');
            }else if(isset($request->checkbox)){
                $checkTrue = explode(',', $getQuest->trueAnswers);
                $countTrue = count($checkTrue);
                $checkArr =  array_diff($checkTrue, $request->checkbox);
                if($countTrue == count($request->checkbox) && $checkArr == []){
                    session()->increment('result');
                }
           }
            if($end->id != $getQuest->id){
                if($hour != null || $minute != null || $second != null) {
                    return redirect()->route('question.showTimer', ['id' => (int)$request->id, 'questId' => (int)$request->questId + 1, 'hour' => $hour, 'minute' => $minute, 'second' => $second]);
                }else{
                    return redirect()->route('question.show', ['id' => (int)$request->id, 'questId' => (int)$request->questId + 1]);
                }
            }else{
                return redirect()->route('testing.result',['id'=>(int)$request->id,'count'=>(int)$count]);
            }
        }
}
