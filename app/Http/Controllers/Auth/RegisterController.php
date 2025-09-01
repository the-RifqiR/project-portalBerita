<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['string', 'required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $email = $request->input('email');
        $pass = $request->input('password');

        $nama = Str::before($email, '@');
        $namaUnik= $nama;
        $unik = 1;
        while(User::where('name', $namaUnik)->exists()){
            $namaUnik = $nama . $unik;
            $unik++;
        }

        $hashPass = Hash::make($pass);

        $createAkun = User::create([
            'name' => $namaUnik,
            'email' => $email,
            'password' => $hashPass,
        ]);

        Auth::login($createAkun);
        $request->session()->flash('register_success', 'Selamat datang, ' . $namaUnik . ' berhasil membuat akun!');
        return redirect()->intended('/');
    }
}
