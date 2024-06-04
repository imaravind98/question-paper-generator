<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return inertia('Login/Index');   
    }

    public function login (Request $request)
    {
        Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ]);
        return to_route('classes.index');
    }

    public function logout()
    {
        return redirect('login');
    }
}
