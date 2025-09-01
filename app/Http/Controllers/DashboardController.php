<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function data(Request $request)
    {
        $user = $request->user();
        $users = User::all(); // ambil semua user
        $berita = Berita::all(); // ambil semua kolom berita
        $userBerita = Berita::where('id_usr', Auth::id())->get(); //ambil kolom data berita sesuai dengan user yang login

        return view('admin.berita.index', compact('users', 'user', 'berita', 'userBerita'));
    }
}
