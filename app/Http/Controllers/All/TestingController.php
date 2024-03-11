<?php
namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Models\Testing;
use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index()
    {
        $allTestings = Testing::select(['id', 'name_test', 'active','content'])->get();
        return view('testings.index', compact('allTestings'));
    }

    public function show($id)
    {
        session()->put('result', 0);
        $test = Testing::find((int)$id)->first();
        if(isset($test) && $test != null){
            if (isset($yesPassed)) {
                return view('all.testings.show',['id'=>$id,compact('test', 'yesPassed')]);
            } else if (isset($notPassed)) {
                return view('all.testings.show', compact('test', 'notPassed'));
            } else {
                return view('all.testings.show', compact('test'));
            }
        }else{
            return abort(404);
        }
    }


    public function result($id, $count)
    {
        $math = Testing::find((int)$id);
        if(isset($math->passing_score) && $math->passing_score != null){
            $name = $math->name_test;
            $percentGo = $math->passing_score;
            $percent = (100 / $count) * session('result');

            if ((int)$math->passing_score <= (int)$percent) {
                $yesPassed = round($percent);
                return view('all.testings.result', compact('yesPassed','percentGo','name'));

            } else if ((int)$math->passing_score > (int)$percent) {
                $notPassed = round($percent);
                return view('all.testings.result', compact('notPassed','percentGo','name'));
            }
        }else{
            return abort(404);
        }
    }
}
