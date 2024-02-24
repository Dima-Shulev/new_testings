<?php
use App\Models\Category;
use App\Models\Question;
use App\Models\Testing;
use App\Models\Page;
/*use App\Models\Review;*/
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

if (!function_exists('name_url')){
    function name_url($result){
        if($result['url'] && !empty($result['url'])){
            $url = trim(str_replace(" ","-",$result['url']));
        }else{
            $url = url_translit($result['name']);
        }
        return $url;
    }
}

if(! function_exists('create_category')) {
    function create_category($result){
        if($result['content'] == null){
            $result['content'] = "null";
        }
        if($result){
            Category::query()->create([
                'name' => $result['name'],
                'content' => $result['content'],
                'metaKey' => $result['metaKey'],
                'metaDescription' => $result['metaDescription'],
                'created_at' => new Carbon($result['created_at']),
                'user_id' => 1,
                'active' => $result['checkPublic'],
                'url' => name_url($result)
            ]);

            return redirect()->route('admin.categories')->with('success','create_category');
        }else{
            return redirect()->route('admin.categories.edit')->with('error','error_create_category');
        }
    }
}

if(! function_exists('update_category')) {
    function update_category($result,$id){
        if($result){
            $update = Category::find((int)$id);
            $update->name = $result['name'];
            $update->content = $result['content'];
            $update->metaKey = $result['metaKey'];
            $update->metaDescription = $result['metaDescription'];
            $update->created_at = new Carbon($result['created_at']);
            $update->user_id = 1;
            $update->active = $result['checkPublic'];
            $update->url = name_url($result);
            $update->save();
            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin','session_auth');
            $session->put('name',$result['name']);
            return redirect()->route('admin.categories')->with('success','update_category');
        }else{
            return redirect()->route('admin.categories.edit')->with('error','error_update_category');
        }
    }
}

if(! function_exists('create_article')){
    function create_article($result){
        if($result){

            Article::query()->create([
                'title' => $result['title'],
                'content' => $result['content'],
                'metaKey' => $result['metaKey'],
                'metaDescription' => $result['metaDescription'],
                'created_at' => new Carbon($result['created_at']),
                'category_id' => $result['selectCategory'],
                'user_id' => 1,
                'active' => $result['checkPublic'],
                'module_name' => $result['module'],
                'url' => name_url($result)
            ]);

            return redirect()->route('admin.articles')->with('success','create_article');
        }else{
            return redirect()->route('admin.articles.edit')->with('error','error_create_article');
        }
    }
}

if(! function_exists('update_article')){
    function update_article($result,$id){
        if($result){
            $update = Article::find((int)$id);
            $update->title = $result['title'];
            $update->content = $result['content'];
            $update->metaKey = $result['metaKey'];
            $update->metaDescription = $result['metaDescription'];
            $update->created_at = new Carbon($result['created_at']);
            $update->user_id = 1;
            if($result['selectCategory'] && !empty($result['selectCategory'])){
                $update->category_id = $result['selectCategory'];
            }
            $update->module_name = $result['module'];
            $update->active = $result['checkPublic'];
            $update->url = name_url($result);
            $update->save();

            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin','session_auth');
            $session->put('title',$result['title']);

            return redirect()->route('admin.articles')->with('success','update_article');
        }else{
            return redirect()->route('admin.articles.edit')->with('error','error_update_article');
        }
    }
}

if(! function_exists('create_page')) {
    function create_page($result){
        if($result){
            if(isset($result['home']))$home = $result['home'];
            else{$home = 'none';}
            Page::query()->create([
                'name' => $result['name'],
                'content' => $result['content'],
                'metaKey' => $result['metaKey'],
                'metaDescription' => $result['metaDescription'],
                'created_at' => new Carbon($result['created_at']),
                'user_id' => 1,
                'active' => 1,
                'home' => $home,
                'url' => name_url($result)
            ]);
            return redirect()->route('admin.pages')->with('success','create_page');
        }else{
            return redirect()->route('admin.pages.edit')->with('error','error_create_pages');
        }
    }
}

if(! function_exists('update_page')) {
    function update_page($result,$id){
    if(!isset($result['home'])) $result['home'] = "none";
         if($result){
            $update = Page::find((int)$id);
            $update->name = $result['name'];
            $update->content = $result['content'];
            $update->metaKey = $result['metaKey'];
            $update->metaDescription = $result['metaDescription'];
            $update->created_at = new Carbon($result['created_at']);
            $update->user_id = 1;
            $update->home = $result['home'];
            $update->active = 1;
            $update->url = name_url($result);
            $update->save();

            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin','session_auth');
            $session->put('name',$result['name']);

            return redirect()->route('admin.pages')->with('success','update_page');
        }else{
            return redirect()->route('admin.pages.edit')->with('error','error_update_page');
        }
    }
}

if(! function_exists('update_review_admin')) {
    function update_review_admin($id,$request,$result){
        $idReview = Review::find((int)$id);
        if($idReview){
            if(!$request['subscription']){
                $result['subscription'] = 0;
            }else{
                $result['subscription'] = 1;
            }
            $idReview->title = $result['title'];
            $idReview->content = $result['content'];
            $idReview->status = $result['subscription'];
            $idReview->save();
        }
        return redirect()->route('admin.reviews');
    }
}


if(! function_exists('check_entrance_room')) {
    function check_entrance_room($checkName,$checkVal){
        if($checkName){
                if (Hash::check($checkVal['password'], $checkName->password)) {
                    session_user($checkName, 'session_admin', 'avatar');
                    return redirect()->route('admin.room')->with('success', 'entrance');
                } else {
                    return redirect()->route('admin')->with('error', 'error_pass');
                }
        }else{
            return redirect()->route('admin')->with('error','error_user_name_or_password');
        }
    }
}

if(! function_exists('check_public_user')) {
    function check_public_user($request,$result){
        if(!isset($request->checkPublic)){
            $result['checkPublic'] = false;
        }else if($request->checkPublic == "on"){
            $result['checkPublic'] = true;
        }
        return $result['checkPublic'];
    }
}

if(! function_exists('update_user')) {
    function update_user($id,$result){
        if($result){
            $query = User::find((int)$id);
            $query->name = $result['name'];
            $query->email = $result['email'];
            $query->password = Hash::make($result['password']);
            $query->created_at = $result['created_at'];
            $query->balance = $result['balance'];
            $query->status = $result['status'];
            $query->save();

            session()->forget('session_admin');
            $session = session();
            $session->put('session_admin','session_auth');
            $session->put('id',$id);
            $session->put('name',$result['name']);
            $session->put('email',$result['email']);
            $session->put('balance',$result['balance']);

            return redirect()->route('admin.users')->with('success','update_user');
        }else{
            return redirect()->route('admin.users.edit')->with('error','error_user');
        }
    }


    if(!function_exists('create_testing')){
        function create_testing($request){

            $count = count($request["questions"]);
            if(!isset($request['created_at']) || $request['created_at'] == null) $request['created_at'] = date("Y-m-d H:i:s");
            if(!isset($request['passing_score']) || $request['passing_score'] == null) $request['passing_score'] =  "50";
            if(!isset($request['metaDescription']) || $request['metaDescription'] == null) $request['metaDescription'] =  "null";
            if(!isset($request['metaKey']) || $request['metaKey'] == null) $request['metaKey'] =  "null";
            if(!isset($request['time']) || $request['time'] == null) $request['time'] =  0;

            $test_id = Testing::create([
                'name_test' => (string)$request["name_test"],
                'content' => (string)$request["name_test"],
                'passing_score' => (string)$request['passing_score'],
                'metaDescription' => (string)$request['metaDescription'],
                'metaKey' => (string)$request['metaKey'],
                'created_at' => (string)$request['created_at'],
                'active' => 1,
                'user_id' => 1,
                'categories_id' => $request['category']
            ]);

            for($i=0; $i<$count; $i++){
                Question::create([
                    'title' => $request['questions'][$i],
                    'trueAnswers' => $request['trueAnswers'][$i],
                    'falseAnswers' => $request['falseAnswers'][$i],
                    'allAnswers' => $request['trueAnswers'][$i].",".$request['falseAnswers'][$i],
                    'description' => $request['description'][$i],
                    'metaKey' => $request['questions'][$i],
                    'metaDescription' => $request['questions'][$i],
                    'testing_id' => $test_id->id
                ]);
            }

            return redirect()->route('admin.testing')->with('success','create_testing');
        }
    }

    if(! function_exists('update_testing')) {
        function update_testing($result, $id){
            $count = Question::where('testing_id',(int)$id)->count('id');
            $idQuest = Question::select('id')->where('testing_id',(int)$id)->orderBy('id','ASC')->get();

            if($result){
                $update = Testing::find((int)$id);
                $update->name_test = $result['name_test'];
                $update->content = $result['content'];
                $update->passing_score = $result['passing_score'];
                $update->active = 0;
                $update->created_at = new Carbon($result['created_at']);
                $update->user_id = 1;
                $update->save();

                session()->forget('session_admin');
                $session = session();
                $session->put('session_admin','session_auth');
                $session->put('name',$result['name_test']);

                for($i=0; $i<$count; $i++){
                    Question::where('title',$result['questions'][$i])->orWhere('id',$idQuest[$i]->id)->update([
                        'title' => $result['questions'][$i],
                        'trueAnswers' => $result['trueAnswers'][$i],
                        'falseAnswers' => $result['falseAnswers'][$i],
                        'allAnswers' => $result['trueAnswers'][$i].",".$result['falseAnswers'][$i],
                        'description' => $result['description'][$i],
                        'testing_id' => $id
                    ]);
                }

                return redirect()->route('admin.testing')->with('success','update_testing');
            }else{
                return redirect()->route('admin.testing.edit')->with('error','error_update_testing');
            }
        }
    }

}
