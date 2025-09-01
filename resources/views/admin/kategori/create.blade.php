@extends('layouts.app')

@section('title', 'Buat Tag')
@section('list-route', route('kategori.index'))
@section('create-route', route('kategori.create'))


@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 mb-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Tambah Kategori Baru</h2>
   
    <form action="{{ route('kategori.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="nama" class="block mb-2 font-medium text-gray-700">Nama Kategori</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                class="w-full px-4 py-2 border-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition
                    @error('nama') border-red-500 @else border-gray-300 @enderror" />
            @error('nama')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tags" class="block mb-2 font-medium text-gray-700">Pilih Tags</label>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($tags as $tag)
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                        {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
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

        <div>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition-shadow shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-700">
                Simpan Kategori
            </button>
        </div>
    </form>
</div>


@endsection