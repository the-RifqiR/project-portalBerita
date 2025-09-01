@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('list-route', route('kategori.index'))
@section('create-route', route('kategori.create'))

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Kategori</h1>

    @if (session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <!-- Form ini mengarah ke rute update dan membawa parameter $category -->
    <form action="{{ route('kategori.update', $kategori) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Nama Kategori -->
        <div>
            <label for="nama" class="block mb-2 font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama', $kategori->title) }}" required
                class="w-full px-4 py-2 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition
                @error('nama') border-red-500 @else border-gray-300 @enderror" />
            @error('nama')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pilih Tags -->
        <div>
            <label for="tags" class="block mb-2 font-medium text-gray-700">Pilih Tags</label>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($tags as $tag)
                <label class="flex items-center space-x-2 cursor-pointer">
                    <!-- Gunakan variabel $selectedTags untuk memeriksa apakah tag sudah terhubung -->
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                        {{ in_array($tag->id, old('tags', $selectedTags)) ? 'checked' : '' }}
                        class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded" />
                    <span class="text-gray-900 text-sm">{{ $tag->title_tag }}</span>
                </label>
                @empty
                <p class="text-gray-500">Tidak ada tag. Silakan tambahkan tag terlebih dahulu.</p>
                @endforelse
            </div>
            @error('tags')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition-shadow shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-700">
                Update Kategori
            </button>
            <a href="{{ route('kategori.index') }}"
                class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-full transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection