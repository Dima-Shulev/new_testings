<?php
namespace App\Http\Controllers\Admin;

use App\Handler\AdminHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ValidateFooter;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index(){
        $links = AdminHandler::pagePaginate(5,Footer::class);
        return view('admin.footer.index',compact('links'));
    }

    public function create(){
        return view('admin.footer.create');
    }

    public function store(ValidateFooter $request){
        $result = $request->validated();
        return AdminHandler::createFooter($result);
    }

    public function edit($url){
        $links = Footer::where('url',$url)->first();
        return view('admin.footer.edit', compact('links','url'));
    }

    public function update($id, ValidateFooter $request){
        $result = $request->validated();
        $result['checkPublic'] = checkPublic($request,$result);
        return AdminHandler::updateFooter($result,$id);
    }

    public function publicFooter($id,$active){
        AdminHandler::publicItem($id,$active,Footer::class);
        return redirect()->route('admin.footer');
    }

    public function deleteFooter($id){
        Footer::find((int)$id)->delete();
        return redirect()->route('admin.footer');
    }
}
