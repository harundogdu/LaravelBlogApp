<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;

class Homepage extends Controller
{
    function __construct()
    {
        view()->share('pages',Page::orderBy('order','ASC')->get());
        view()->share('categories', Category::inRandomOrder()->get());
    }
    public function index()
    {
        $data['articles']= Article::orderBy('created_at','DESC')->paginate(2)->withPath(url('yazilar/sayfa'));
        return view('front.homepage',$data);
    }
    public function singlePage($category,$slug)    
    {
        $category = Category::whereSlug($category)->first() ?? abort(403,'Böyle bir kategori bulunamadı.');
        $article= Article::where('slug',$slug)->whereCategoryId($category->id)->first() ?? abort(403,'Sayfa Bulunamadı.');
        $article->increment('hit');        
        $data['article'] = $article;
        return view('front.post',$data);
    }
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403,"Böyle bir kategori yok.");
        $data['articles'] = Article::where('category_id',$category->id)->orderBy('created_at','DESC')->paginate(2);
        $data['category'] = $category;
        return view('front.category',$data);
    }
    public function pages($slug)
    {
        $data['page'] = Page::whereSlug($slug)->first() ?? abort(403,'Böyle bir sayfa bulunamadı.');
        return view('front.page',$data);
    }
}
