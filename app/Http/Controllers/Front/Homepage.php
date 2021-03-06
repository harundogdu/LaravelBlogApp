<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Homepage extends Controller
{
    function __construct()
    {
        if(Config::find(1)->active == 0){
            return redirect()->to('site-bakimda')->send();
        }
        view()->share('pages', Page::where('status',1)->orderBy('order', 'ASC')->get());
        view()->share('categories', Category::where('status',1)->orderBy('name','ASC')->get());
       
    }
    public function index()
    {
        $data['articles'] = Article::where('status',1)->orderBy('created_at', 'DESC')->paginate(2)->withPath(url('yazilar/sayfa'));
        return view('front.homepage', $data);
    }
    public function singlePage($category, $slug)
    {
        $category = Category::whereSlug($category)->first() ?? abort(403, 'Böyle bir kategori bulunamadı.');
        $article = Article::where('slug', $slug)->whereCategoryId($category->id)->first() ?? abort(403, 'Sayfa Bulunamadı.');
        $article->increment('hit');
        $data['article'] = $article;
        return view('front.post', $data);
    }
    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403, "Böyle bir kategori yok.");
        $data['articles'] = Article::where('status','1')->where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate(2);
        $data['category'] = $category;
        return view('front.category', $data);
    }
    public function pages($slug)
    {
        $data['page'] = Page::whereSlug($slug)->first() ?? abort(403, 'Böyle bir sayfa bulunamadı.');
        return view('front.page', $data);
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function contactPost(Request $request)
    {
        $rules = [
            'name' => 'min:3|max:15|required',
            'email' => 'min:3|required',
            'phone' => 'min:10|required',
            'topic' => 'required',
            'message' => 'min:10|required'
        ];

        $validate = Validator::make($request->post(), $rules);

        if ($validate->fails()) {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }
        
        // mailtrap

        Mail::send([], [], function ($message) use($request) {
            $message->from('iletisim@harundogdu.com.tr', 'Harun Doğdu İletişim');
            $message->to('harundogdu06@gmail.com', 'Harun Doğdu');            
            $message->setBody("
                            Mesajı Gönderen : ". $request->name ."<br>
                            Mesajı Gönderen Email : ". $request->email ."<br>
                            Mesajın Konusu : ".$request->topic."<br>
                            Mesaj : ". $request->message ."<br>
                            Mesaj Gönderilme Zamanı : ". now() ."","text/html");
            $message->subject($request->name . ' isimli kişi harundogdu.com.tr/iletisim üzerinden mesaj gönderdi.');
        });
        
        
        // Database save
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->topic = $request->topic;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->route('contact')->with('success', 'Mesajınız Başarıyla Gönderildi.');
    }
}
