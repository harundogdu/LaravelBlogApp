<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class Homepage extends Controller
{
    public function index()
    {
        $data['articles']= Article::orderBy('created_at','DESC')->get();
        $data['categories'] = Category::inRandomOrder()->get();
        return view('front.homepage',$data);
    }
    public function singlePage($slug)
    {
        $article= Article::where('slug',$slug)->first() ?? abort(404,'Sayfa Bulunamadı.');
        $article->increment('hit');        
        $data['article'] = $article;
        $data['categories']= Category::inRandomOrder()->get();
        return view('front.post',$data);
    }
}
