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
    public function singlePage($category,$slug)    
    {
        $category = Category::whereSlug($category)->first() ?? abort(403,'Böyle bir kategori bulunamadı.');
        $article= Article::where('slug',$slug)->whereCategoryId($category->id)->first() ?? abort(403,'Sayfa Bulunamadı.');
        $article->increment('hit');        
        $data['article'] = $article;
        $data['categories']= Category::inRandomOrder()->get();
        return view('front.post',$data);
    }
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403,"Böyle bir kategori yok.");
        $data['articles'] = Article::where('category_id',$category->id)->orderBy('created_at','DESC')->get();
        $data['category'] = $category;
        $data['categories'] = Category::inRandomOrder()->get();
        return view('front.category',$data);
    }
}
