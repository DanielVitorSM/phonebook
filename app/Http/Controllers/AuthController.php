<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function store(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'name' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        if($user) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/');
        }
        
        return back()->withErrors([
            'failed' => "Erro ao criar nova conta"
        ]);
    }

    public function attempt(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'credentials' => "Email ou senha inválidos"
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
}
