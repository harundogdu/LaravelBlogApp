<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at','DESC')->get();
        return view('back.articles.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('back.articles.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'min:5',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

        $article = new Article;
        $article->category_id = $request->category_id;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title);

        if($request->hasFile('image')){
            $imageName = Str::slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image = 'uploads/'.$imageName;
        }
        $article->save();

        toastr()->success('Tebrikler', 'Makale Başarıyla Eklendi!');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('back.articles.update',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $article = Article::findOrFail($id);
       $article->title = $request->title;
       $article->category_id = $request->category_id;
       $article->content = $request->content;

       if($request->hasFile('image')){
            $imageName = Str::slug($request->title).'.'. $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'),$imageName);
            $article->image = 'uploads/'.$imageName;
       }

       $article->save();
       toastr()->success('Başarılı','Makale Başarıyla Güncellendi');

       return redirect()->route('admin.makaleler.index');
       
    }

    public function switch(Request $request)
    {
        $article = Article::findOrFail($request->id);
        $article->status = $request->statu=="true" ? 1 : 0;
        $article->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
