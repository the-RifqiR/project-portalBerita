<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $dataLogin = $request->validate(
            [
                'email' => ['string', 'required', 'email', 'max:255'],
                'password' => ['required', 'string'],
            ]
        );



        if (Auth::attempt($dataLogin)) {
            $user = Auth::user();

            $request->session()->flash('login_success', 'Selamat datang, '. $user->name .' berhasil login!');
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Harap masukan Email yang benar, karena tidak ditemukan Email tersebut.',
            'password' => 'Harap masukan Email yang benar, karena tidak ditemukan Email tersebut.'
        ])->onlyInput('email', 'password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
