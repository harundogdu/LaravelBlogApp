<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index',compact('categories'));
    }
    public function create(Request $request)
    {
       $isCategory = Category::whereSlug(Str::slug($request->name))->first();
       if($isCategory){
        toastr()->error($request->name . " adında bir kategori zaten var!","İşlem Başarısız");
        return redirect()->back();
       }

       $category = new Category;
       $category->name = $request->name;
       $category->slug = Str::slug($request->name);
       $category->save();

       toastr()->success('Kategori Başarıyla Eklendi','İşlem Başarılı');
       return redirect()->back();
    }
    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu == "true" ? 1 : 0;
        $category->save();
    }
}
