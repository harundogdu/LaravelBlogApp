<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('back.auth.login');
    }
}
