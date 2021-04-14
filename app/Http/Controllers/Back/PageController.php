<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('order','ASC')->get();
        return view('back.pages.index', compact('pages'));
    }
    public function switch(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->status = $request->statu == "true" ? 1 : 0;
        $page->save();
    }
    public function createPage(Request $request)
    {
        $request->validate([
            'title' => 'min:5',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);

        $lastOrder = Page::orderBy('order', 'DESC')->first();

        $page = new Page;
        $page->title = $request->title;
        $page->content = trim($request->content);
        $page->slug = Str::slug($request->title);
        $page->order = $lastOrder->order + 1;

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/' . $imageName;
        }
        $page->save();

        toastr()->success('Sayfa Başarıyla Eklendi!', 'İşlem Başarılı');
        return redirect()->route('admin.sayfalar.index');
    }
    public function create()
    {
        return view('back.pages.create');
    }
    public function update($id)
    {
        $page = Page::findOrFail($id);
        return view('back.pages.update', compact('page'));
    }
    public function updatePage(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->title = $request->title;
        $page->content = trim($request->content);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/' . $imageName;
        }

        $page->save();
        toastr()->success('Sayfa Başarıyla Güncellendi', 'İşlem Başarılı');

        return redirect()->route('admin.sayfalar.index');
    }

    public function delete($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
        toastr()->success('Sayfa Başarıyla Silindi!', 'İşlem Başarılı');
        return redirect()->back();
    }

    public function pageSort(Request $request)
    {
        foreach ($request->get('page') as $key => $value) {
            Page::where('id', $value)->update(['order' => $key]);
        }
    }
}
