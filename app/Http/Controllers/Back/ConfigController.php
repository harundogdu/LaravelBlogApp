<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::find(1)->first();
        return view('back.config.index',compact('config'));
    }

    public function update(Request $request)
    {
        $config = Config::find(1)->first();
        $config->title = $request->title;
        $config->active = $request->active;
        $config->facebook =$request->facebook;
        $config->instagram =$request->instagram;
        $config->linkedin =$request->linkedin;
        $config->youtube =$request->youtube;
        $config->github =$request->github;
        $config->twitter =$request->twitter;
        $config->aboutOfCreator = $request->aboutOfCreator;

        if($request->hasFile('favicon')){
            $favIconName = Str::slug($request->title)."-favicon.".$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'),$favIconName);
            $config->favicon = "uploads/".$favIconName;
        }
        if($request->hasFile('logo')){
            $logoName = Str::slug($request->title)."-logo.".$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'),$logoName);
            $config->logo = "uploads/".$logoName;           
        }
        $config->save();
        toastr()->success('Site Ayarları Başarıyla Güncellendi!', 'İşlem Başarılı');
        return redirect()->back();
    }
}
