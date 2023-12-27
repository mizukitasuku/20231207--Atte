<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function registerView()
    {
        return view('register');
    }

    public function register(Request $request)
    {

    }
}
