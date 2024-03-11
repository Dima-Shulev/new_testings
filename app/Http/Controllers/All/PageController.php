<?php
namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Testing;
use App\Models\Question;
use App\Models\Category;
use GuzzleHttp\Psr7\Request;

class PageController extends Controller
{
    public function index(){
        $home = Page::where('home','on')->first();
        return view('all.index',compact('home'));
    }
    public function show($url){
        $checkUrl = Page::select(['url'])->where('url', $url)->orderBy('id', 'ASC')->first();
        if ($checkUrl != null) {
            if(isset($_GET['query'])) {
                $response = $_GET['query'];
                $response = strtolower(str_replace(" ",'',trim(htmlspecialchars($response))));
                $show = Page::select(['id', 'name', 'content', 'metaKey', 'metaDescription', 'url'])->where('url', $url)->orderBy('id', 'ASC')->first();
                $searchTesting = Testing::where('name_test','like', "%{$response}%")->orWhere('content','like', "%{$response}%")->get();

                if ($searchTesting) {
                    return view('all.show', compact('show', 'searchTesting'));
                }
            }
           $show = Page::select(['id', 'name', 'content', 'metaKey', 'metaDescription', 'url'])->where('url', $url)->orderBy('id', 'ASC')->first();
           return view('all.show', compact('show'));
        } else if ($url === "login") {
            return view('all.login.index');
        } else if ($url === "register") {
            return view('all.register.index');
        } else if ($url === "admin") {
            return view('admin.admin');
        } else {
            abort(404);
        }
    }
}
