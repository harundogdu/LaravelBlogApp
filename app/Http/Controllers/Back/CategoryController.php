<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('back.categories.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $isCategory = Category::whereSlug(Str::slug($request->name))->first();
        if ($isCategory) {
            toastr()->error($request->name . " adında bir kategori zaten var!", "İşlem Başarısız");
            return redirect()->back();
        }

        $category = new Category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();

        toastr()->success('Kategori Başarıyla Eklendi', 'İşlem Başarılı');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $isSlug = Category::whereSlug(Str::slug($request->slug))->whereNotIn('id',[$request->category_id])->first();
        $isCategory = Category::whereName($request->category)->whereNotIn('id',[$request->category_id])->first();

        if ($isCategory or $isSlug) {
            toastr()->error($request->category . " kategori veya slug değeri zaten var!", "İşlem Başarısız");
            return redirect()->back();
        }

        $category = Category::find($request->category_id);
        $category->name = $request->category;
        $category->slug = Str::slug($request->slug);
        $category->save();

        toastr()->success('Kategori Başarıyla Eklendi', 'İşlem Başarılı');
        return redirect()->back();
    }

    public function getData(Request $request)
    {
        $category = Category::find($request->id);
        return response($category);
    }

    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu == "true" ? 1 : 0;
        $category->save();
    }
    public function delete(Request $request)
    {
        $defaultCategory = Category::find(1);
        $category = Category::findOrFail($request->category_id);

        if($category->id == $defaultCategory->id){
            toastr()->error('Bu kategori silinemez!','İşlem Başarısız');
            return redirect()->back();
        }

        $message = "Kategori başarıyla silindi";
        $count = $category->getArticleCount();        

        if($count > 0){
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
            $message = "Kategori başarıyla silindi! içerisindeki " . $count . " makale " . $defaultCategory->name  . " kategorisine taşındı !";
        }      

        $category->delete();
        toastr()->success($message,'İşlem Başarılı');
        return redirect()->back();
      
    }
}
