<?php

namespace App\Http\Controllers\All;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use App\Models\Testing;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function show($url)
    {
        $show = Footer::where('url', $url)->first();
        if ($show) {
            if (isset($_GET['query'])) {
                $response = $_GET['query'];
                $response = strtolower(str_replace(" ", '', trim(htmlspecialchars($response))));
                $searchTesting = Testing::where('name_test', 'like', "%{$response}%")->orWhere('content', 'like', "%{$response}%")->get();
                if ($searchTesting) {
                    return view('all.footer.show', compact('show', 'searchTesting'));
                }
            }
            return view('all.footer.show', compact('show'));
        }else{
            return abort(404);
        }
    }


}
