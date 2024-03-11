<?php
namespace App\Handler;

use App\Models\Category;
use App\Models\Footer;
use App\Models\Page;
use App\Models\Question;
use App\Models\Testing;
use App\Models\User;
use Carbon\Traits\Creator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminHandler extends ParentHandler
{

    public static function nameUrl($result)
    {
        if ($result['url'] && !empty($result['url'])) {
            $url = trim(str_replace(" ", "-", $result['url']));
        } else {
            $url = AdminHandler::urlTranslit($result['name']);
        }
        return $url;
    }

    public static function createCategory($result)
    {
        if ($result['content'] == null) {
            $result['content'] = "null";
        }
        if ($result) {
            Category::query()->create([
                'name' => $result['name'],
                'content' => $result['content'],
                'metaKey' => $result['metaKey'],
                'metaDescription' => $result['metaDescription'],
                'created_at' => new Carbon($result['created_at']),
                'user_id' => 1,
                'active' => 1,
                'url' => AdminHandler::nameUrl($result)
            ]);

            return redirect()->route('admin.categories')->with('success', 'create_category');
        } else {
            return redirect()->route('admin.categories.edit')->with('error', 'error_create_category');
        }
    }

    public static function updateCategory($result, $id)
    {
        if ($result) {
            $update = Category::find((int)$id);
            $update->name = $result['name'];
            $update->content = $result['content'];
            $update->metaKey = $result['metaKey'];
            $update->metaDescription = $result['metaDescription'];
            $update->created_at = new Carbon($result['created_at']);
            $update->user_id = 1;
            $update->active = $result['checkPublic'];
            $update->url = AdminHandler::nameUrl($result);
            $update->save();
            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin', 'session_auth');
            $session->put('name', $result['name']);
            return redirect()->route('admin.categories')->with('success', 'update_category');
        } else {
            return redirect()->route('admin.categories.edit')->with('error', 'error_update_category');
        }
    }

    public static function createPage($result)
    {
        if ($result) {
            if (isset($result['home'])) $home = $result['home'];
            else {
                $home = 'none';
            }
            Page::query()->create([
                'name' => $result['name'],
                'content' => $result['content'],
                'metaKey' => $result['metaKey'],
                'metaDescription' => $result['metaDescription'],
                'created_at' => new Carbon($result['created_at']),
                'user_id' => 1,
                'active' => 1,
                'home' => $home,
                'url' => AdminHandler::nameUrl($result)
            ]);
            return redirect()->route('admin.pages')->with('success', 'create_page');
        } else {
            return redirect()->route('admin.pages.edit')->with('error', 'error_create_pages');
        }
    }

    public static function updatePage($result, $id)
    {
        if (!isset($result['home'])) $result['home'] = "none";
        if ($result) {
            $update = Page::find((int)$id);
            $update->name = $result['name'];
            $update->content = $result['content'];
            $update->metaKey = $result['metaKey'];
            $update->metaDescription = $result['metaDescription'];
            $update->created_at = new Carbon($result['created_at']);
            $update->user_id = 1;
            $update->home = $result['home'];
            $update->active = 1;
            $update->url = AdminHandler::nameUrl($result);
            $update->save();
            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin', 'session_auth');
            $session->put('name', $result['name']);

            return redirect()->route('admin.pages')->with('success', 'update_page');
        } else {
            return redirect()->route('admin.pages.edit')->with('error', 'error_update_page');
        }
    }


    public static function createFooter($result)
    {
        $result['position'] = isset($result['position']) && $result['position'] != null ? $result['position'] : "right";
        if ($result) {
            Footer::query()->create([
                'link' => $result['name'],
                'content' => $result['content'],
                'metaKey' => $result['metaKey'],
                'metaDescription' => $result['metaDescription'],
                'created_at' => new Carbon($result['created_at']),
                'position'=> $result['position'],
                'user_id' => 1,
                'active' => 1,
                'url' => AdminHandler::nameUrl($result)
            ]);
            return redirect()->route('admin.footer')->with('success', 'create_link_footer');
        } else {
            return redirect()->route('admin.footer.edit')->with('error', 'error_create_link_footer');
        }
    }

    public static function updateFooter($result, $id)
    {
        $result['position'] = isset($result['position']) && $result['position'] != null ? $result['position'] : "right";
        if ($result) {
            $update = Footer::find((int)$id);
            $update->link = $result['name'];
            $update->content = $result['content'];
            $update->metaKey = $result['metaKey'];
            $update->metaDescription = $result['metaDescription'];
            $update->created_at = new Carbon($result['created_at']);
            $update->position = $result['position'];
            $update->user_id = 1;
            $update->active = 1;
            $update->url = AdminHandler::nameUrl($result);
            $update->save();
            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin', 'session_auth');
            $session->put('name', $result['name']);

            return redirect()->route('admin.footer')->with('success', 'update_link_footer');
        } else {
            return redirect()->route('admin.footer.edit')->with('error', 'error_update_link_footer');
        }
    }

    public static function checkEntranceRoom($checkName, $checkVal)
    {
        if ($checkName) {
            if (Hash::check($checkVal['password'], $checkName->password)) {
                AdminHandler::sessionUser($checkName, 'session_admin', 'avatar');
                return redirect()->route('admin.room')->with('success', 'entrance');
            } else {
                return redirect()->route('admin')->with('error', 'error_pass');
            }
        } else {
            return redirect()->route('admin')->with('error', 'error_user_name_or_password');
        }
    }

    public static function updateUser($id, $result)
    {
        if ($result) {
            $query = User::find((int)$id);
            $query->name = $result['name'];
            $query->email = $result['email'];
            $query->password = Hash::make($result['password']);
            $query->created_at = $result['created_at'];
            $query->balance = $result['balance'];
            $query->pay = $result['pay'];
            $query->status = $result['status'];
            $query->save();
            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin', 'session_auth');
            $session->put('id', $id);
            $session->put('name', $result['name']);
            $session->put('email', $result['email']);
            $session->put('balance', $result['balance']);

            return redirect()->route('admin.users')->with('success', 'update_user');
        } else {
            return redirect()->route('admin.users.edit')->with('error', 'error_user');
        }
    }

    public static function createTesting($request){
        $count = count($request["questions"]);
        if(!isset($request['created_at']) || $request['created_at'] == null) $request['created_at'] = date("Y-m-d H:i:s");
        if(!isset($request['passing_score']) || $request['passing_score'] == null) $request['passing_score'] =  "50";
        if(!isset($request['metaDescription']) || $request['metaDescription'] == null) $request['metaDescription'] =  "null";
        if(!isset($request['metaKey']) || $request['metaKey'] == null) $request['metaKey'] =  "null";
        $show_answers = !isset($request['show_answers'])?"off":$request['show_answers'];
        $time = !isset($request['time']) || $request['time'] == null ? 0 : $request['time'];

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
            'user_id' => 1,
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
        return redirect()->route('admin.testing')->with('success', 'create_testing');
    }


    public static function updateTesting($result, $id)
    {
        $count = Question::where('testing_id',(int)$id)->count('id');
        $idQuest = Question::select('id')->where('testing_id',(int)$id)->orderBy('id','ASC')->get();
        if($idQuest == null){
            return abort(404);
        }
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
            $update->categories_id = $result['category'];
            $update->user_id = 1;
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
            return redirect()->route('admin.testing')->with('success', 'update_testing');
        } else {
            return redirect()->route('admin.testing.edit')->with('error', 'error_update_testing');
        }
    }

    /*public static function template()
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
    }*/
}
