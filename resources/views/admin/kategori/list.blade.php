@extends('layouts.guest')

<style>
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

@section('title', 'Kategori List')



@section('content')
<h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Semua Kategori</h1>

@if($kategori->isEmpty())
<p class="text-center text-gray-600">Belum ada kategori yang tersedia.</p>
@else
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($kategori as $item)
    <a href="{{ route('index', ['kategori' => $item->slug]) }}" class="relative w-full h-48 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition duration-300 ease-in-out group">
        @if($item->image_url)
        <img src="{{ asset($item->image_url) }}" alt="Gambar Kategori {{ $item->title }}" class="w-full h-full object-cover">
        @else
        <div class="w-full h-full bg-gray-400"></div>
        @endif
        <div class="overlay group-hover:bg-opacity-70 transition duration-300">
            <span class="text-white text-lg sm:text-xl font-bold text-center px-4">{{ $item->title }}</span>
        </div>
    </a>
    @endforeach
</div>
@endif
@endsection