<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

        public function logoutView()
    {
        return view('login');
    }

    public function login(Request $request)
    {

    }

    public function logout(Request $request)
    {

    }
}
