<?php

namespace App\Http\Controllers\Berita;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Tag;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function show(Kategori $kategori)
    {
        $kategori->load('tags'); 
        return view('admin.kategori.show', compact('kategori'));
    }

    // Tampilkan semua kategori
    public function index()
    {
        $categories = Kategori::with('tags')->get();
        $tags = Tag::all(); 
        return view('admin.kategori.index', compact('categories', 'tags'));
    }

    public function list()
    {
        $kategori = Kategori::all();
         
        return view('admin.kategori.list', compact('kategori'));
    }

    // Form tambah kategori
    public function create()
    {
        $tags = Tag::all();
        return view('admin.kategori.create', compact('tags'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,title',
            'tags' => 'array'
        ]);

        $kategori = Kategori::create([
            'title' => $request->nama,
            'slug'  => Str::slug($request->nama),
        ]);

        if ($request->tags) {
            $kategori->tags()->attach($request->tags);
        }

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Form edit kategori
    public function edit(Kategori $kategori)
    {
        $tags = Tag::all();
        $selectedTags = $kategori->tags->pluck('id')->toArray();
        return view('admin.kategori.edit', compact('kategori', 'tags', 'selectedTags'));
    }

 
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,title,' . $kategori->id,
            'tags' => 'array'
        ]);

        $kategori->update([
            'title' => $request->nama,
            'slug'  => Str::slug($request->nama),
        ]);

        $kategori->tags()->sync($request->tags ?? []);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    
    public function destroy(Kategori $kategori)
    {
        $kategori->tags()->detach();
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }

    public function getTags(Kategori $kategori)
    {
        return response()->json($kategori->tags);
    }
}
