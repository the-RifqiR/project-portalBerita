@extends('layouts.guest')

@section('title', $berita->judul)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-8">
        {{ $berita->user->name ?? 'Pengguna Tidak Dikenal' }}
        <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">{{ $berita->judul }}</h1>

        <p class="text-gray-600 text-sm mb-6">
            Diposting pada: {{ $berita->created_at->format('d F Y') }} | Kategori: {{ $berita->kategori->title }}
        </p>

        @if($berita->image)
        <img src="{{ asset($berita->image) }}" alt="{{ $berita->judul }}"
            class="w-full aspect-video rounded-lg shadow-md mb-8 object-cover">
        @endif

        <div class="prose max-w-none text-gray-800 leading-relaxed">
            {!! clean($berita->deskripsi) !!}
        </div>

        @if($berita->tags->isNotEmpty())
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-700 mb-3">Tags:</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($berita->tags as $tag)
                <span class="bg-gray-200 text-gray-700 text-xs font-medium px-2.5 py-0.5 rounded-full">
                    {{ $tag->title_tag }}
                </span>
                @endforeach
            </div>
        </div>
        @endif

        <div class="mt-12 text-center">
            <a href="{{ url('/') }}"
                class="inline-block px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection