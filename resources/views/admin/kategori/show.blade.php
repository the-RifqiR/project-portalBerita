@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 max-w-2xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-3xl font-bold text-gray-800">{{ $kategori->title }}</h1>
        <a href="{{ route('kategori.index') }}" class="text-blue-600 hover:underline">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <hr class="my-4 border-gray-200" />

    <p class="text-xl font-semibold text-gray-700 mb-2">Tags Terkait:</p>
    @if($kategori->tags->isEmpty())
        <p class="text-gray-500">Tidak ada tag yang terkait dengan kategori ini.</p>
    @else
        <ul class="list-disc list-inside space-y-1 text-gray-800">
            @foreach($kategori->tags as $tag)
            <li>{{ $tag->title_tag }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
