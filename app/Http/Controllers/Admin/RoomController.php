<?php
namespace App\Http\Controllers\Admin;

use App\Handler\AdminHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidEntranceRoomRequest;
use App\Models\Category;
use App\Models\Testing;
use App\Models\User;

class RoomController extends Controller
{
    public function admin(){
        return view('admin.admin');
    }
    public function entrance(ValidEntranceRoomRequest $request){
        $checkVal = $request->validated();
        $checkName = User::where('name',$checkVal['name'])->where('status','admin')->first();
        return AdminHandler::checkEntranceRoom($checkName,$checkVal);
    }

    public function index(){
            $showLastUser = AdminHandler::selectLast(User::class,'name','active','created_at');
            $countUser = User::count();
            $showLastCategory = AdminHandler::selectLast(Category::class,'name','active','created_at');
            $countCategory = Category::count();
            $showLastTesting = AdminHandler::selectLast(Testing::class,'name_test','active','created_at');
            $countTesting = Testing::count();

            $countAndShow = [
            'countUser' => $countUser,
            'showLastUser' => $showLastUser,
            'showLastCategory' => $showLastCategory,
            'countCategory' => $countCategory,
            'showLastTesting' => $showLastTesting,
            'countTesting' => $countTesting,
            /*'countReviews' => $countReviews,
            'showLastReviews' => $showLastReviews,
            'countArticle' => $countArticle,
            'showLastArticle' => $showLastArticle,
            */
        ];

        return view('admin.room.index',compact('countAndShow'));
    }

    public function closeSession(){
        session()->flush();
        return redirect('/admin');
    }
}
