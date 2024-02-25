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

    public function show($id){
        session()->put('result', 0);
        $test = Testing::find((int)$id)->first();
        if (isset($yesPassed)) {
            return view('all.testings.show',['id'=>$id,compact('test', 'yesPassed')]);
        } else if (isset($notPassed)) {
            return view('all.testings.show', compact('test', 'notPassed'));
        } else {
            return view('all.testings.show', compact('test'));
        }
    }


    public function result($id, $count)
    {
        $math = Testing::find((int)$id);
        $percentGo = $math->passing_score;
        $percent = (100 / $count) * session('result');

        $yesPassed = "Поздравляю, Вы прошли тест. Ваш результат - ";
        $notPassed = "Увы, но Вы не прошли тест. Ваш результат - ";

        if ((int)$math->passing_score <= (int)$percent) {
            $yesPassed .= $percent . "%";
            return view('all.testings.result', compact('yesPassed','percentGo'));

        } else if ((int)$math->passing_score > (int)$percent) {
            $notPassed .= $percent . "%";
            return view('all.testings.result', compact('notPassed','percentGo'));
        }
    }
}
