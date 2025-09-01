<?php

namespace App\Http\Controllers\Berita;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->get();
        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_tag' => 'required|string|max:255|unique:tag,title_tag',
        ]);

        Tag::create([
            'title_tag' => $request->title_tag,
            'slug_tag' => Str::slug($request->title_tag),
        ]);

        return redirect()->route('tags.index')->with('success', 'Tag berhasil ditambahkan!');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }


    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'title_tag' => 'required|string|max:255|unique:tag,title_tag,' . $tag->id,
        ]);

        $tag->update([
            'title_tag' => $request->title_tag,
            'slug_tag' => Str::slug($request->title_tag),
        ]);

        return redirect()->route('tags.edit')->with('success', 'Tag berhasil diperbarui!');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag berhasil dihapus!');
    }
}
