<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Page;
use App\Models\Category;
use App\Models\Config;

class Dashboard extends Controller
{
    public function index()
    {  
        $article = Article::all()->count(); 
        $page = Page::all()->count(); 
        $category = Category::all()->count(); 
        $articleHit = Article::sum('hit');
        $config = Config::find(1);
        return view('back.dashboard',compact('article','page','category','articleHit','config'));
    }
}
