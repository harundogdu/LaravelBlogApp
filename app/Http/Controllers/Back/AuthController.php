<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }
    public function loginPost(Request $request)
    {
    /*     $credentials = $request->only('email', 'password');
        if(Auth::guard('admin')->login($credentials))
       {         
            return redirect()->route('admin.dashboard');
       } */
       if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
       {         
            return redirect()->route('admin.dashboard');
       }
        return redirect()->route('admin.login')->withErrors('Kullanıcı adı veya şifre hatalı');        
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
