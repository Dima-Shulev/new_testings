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
            $allQuestionsTest = Question::select(['id','title','testing_id'])->where('testing_id',$id)->get();
            return view('questions.index',compact('allQuestionsTest','count'));
        }

        public function show($id, $questId)
        {
            $getQuest = Question::where("testing_id", (int)$id)->where('id', $questId)->first();
            return view('questions.show',compact('getQuest'));
        }

        public function store(Request $request){
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
                return redirect()->route('question.show',['id'=>(int)$request->id,'questId'=>(int)$request->questId+1]);
            }else{
                return redirect()->route('testing.result',['id'=>(int)$request->id,'count'=>(int)$count]);
            }
        }







}
