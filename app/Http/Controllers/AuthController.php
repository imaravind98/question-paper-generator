<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('export.index');
        }
        return inertia('Login/Index'); 
    }

    public function login (Request $request)
    {
        if(Auth::attempt($request->validate([
            'email' => 'email|required',
            'password' => 'string|required|max:20|min:8'
        ]))){
            return to_route('export.index');
        }
        else{
            return back()->withErrors([
                'email' => 'Email or Password is incorrect.',
            ])->withInput();
        }
        
    }

    public function logout()
    {
        Auth::logout();
        Session::regenerate(true);
    }
}
