<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Kategori;

class HomePageController extends Controller
{
    public function index(Request $request)
    {

        // Ambil 5 kategori terbaru untuk filter
        $kategoriTerbaru = Kategori::latest()->take(9)->get();

        // Kalau ada kategori dipilih via query string (?kategori=slug)
        $query = Berita::with('kategori', 'tags');

        if ($request->has('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $berita = $query->latest()->paginate(9);

        return view('dashboard', compact('berita', 'kategoriTerbaru'));
    }

    public function showBerita($slug){
        $berita = Berita::where('slug_berita', $slug)->firstOrFail();

        return view('showBerita', compact('berita'));
    }

     public function kategori()
    {
        // Halaman khusus semua kategori
        $kategori = Kategori::latest()->paginate(15);

        return view('dashboard', compact('kategori'));
    }
}
