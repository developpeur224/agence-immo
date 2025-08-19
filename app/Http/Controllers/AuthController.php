<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    const REDIRECT_AFTER_LOGIN = 'admin.property.index';
    
    public function login()
    {
        return view('auth.login');
    }

    public function doLogout(LoginRequest $request)
    {
        $credentials = $request->validated();
        
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended(route(self::REDIRECT_AFTER_LOGIN));
        }

        return back()->withErrors([
            'email' => 'identifiants incorrects.'
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('success', 'Vous avez été déconnecté avec succès.');
    }
}
