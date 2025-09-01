<?php

namespace App\Http\Controllers\Berita;

use App\Http\Controllers\Controller;

use App\Models\Berita;
use App\Models\Kategori;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Mews\Purifier\Facades\Purifier;

class BeritaController extends Controller
{
    public function showFormCreate()
    {
        $kategoris = Kategori::all();
        $tags = Tag::all();

        return view('admin.berita.create', compact('kategoris', 'tags'));
    }

    public function createData(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|exists:kategori,id',
            'deskripsi' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tag,id',
        ]);

        
        $validated['id_kat'] = $validated['kategori'];
        unset($validated['kategori']);

        
        $slug = Str::slug($validated['judul']);
        $jumlahSlug = Berita::where('slug_berita', 'LIKE', "{$slug}%")->count();
        $validated['slug_berita'] = $jumlahSlug ? "{$slug}-{$jumlahSlug}" : $slug;

        
        $path = $request->file('image')->store('berita_thumbnail', 'public');
        $validated['image'] = '/storage/' . $path;

        $validated['id_usr'] = Auth::id();

        
        $validated['deskripsi'] = Purifier::clean($validated['deskripsi']);

        
        $berita = Berita::create($validated);

        
        if (!empty($validated['tags'])) {
            $berita->tags()->attach($validated['tags']);
        }

        return redirect()->route('berita.dashboard')->with('success', 'Berita berhasil ditambahkan!');
    }


    public function showFormEdit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategoris = Kategori::all();
        $tags = Tag::all();
        $tagsLainnya = $berita->tags->pluck('id')->toArray();

        return view('admin.berita.edit', compact('berita', 'kategoris', 'tags', 'tagsLainnya'));
    }


    public function updateData(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'slug' => ['nullable', 'string', Rule::unique('berita', 'slug_berita')->ignore($berita->id)],
            'kategori' => 'required|exists:kategori,id',
            'deskripsi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tag,id',
        ]);

        //  pembaruan gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama 
            if ($berita->image && Storage::disk('public')->exists(str_replace('/storage/', '', $berita->image))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $berita->image));
            }
            // Simpan gambar baru
            $path = $request->file('image')->store('berita_thumbnail', 'public');
            $validated['image'] = '/storage/' . $path;
        }

        // Data untuk update, 
        $updateData = [
            'judul' => $validated['judul'],
            'id_kat' => $validated['kategori'],
            'deskripsi' => Purifier::clean($validated['deskripsi']),
        ];

       
        if (isset($validated['slug'])) {
            $updateData['slug_berita'] = $validated['slug'];
        } else {
            $updateData['slug_berita'] = Str::slug($validated['judul']);
        }
        
      
        if (isset($validated['image'])) {
            $updateData['image'] = $validated['image'];
        }

        $berita->update($updateData);

        $berita->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('berita.dashboard')->with('success', 'Berita berhasil diperbarui!');
    }


    public function deleteData($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->image && Storage::disk('public')->exists(str_replace('/storage/', '', $berita->image))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $berita->image));
        }

        $berita->tags()->detach();
        $berita->delete();

        return redirect()->route('berita.dashboard')->with('success', 'Berita berhasil dihapus!');
    }
}
