@extends('layouts.app')

@section('title', 'Manajemen Tag')
@section('list-route', route('tags.index'))
@section('create-route', route('tags.create'))

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Edit Tag</h2>
    <form action="{{ route('tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title_tag" class="block text-gray-700 text-sm font-bold mb-2">Nama Tag</label>
            <input type="text" id="title_tag" name="title_tag" value="{{ $tag->title_tag }}" required
                class="w-full px-4 py-2 border-2 border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition" />
        </div>
        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition">
                Perbarui Tag
            </button>
            <a href="{{ route('tags.index') }}" class="ml-2 inline-block text-gray-600 hover:text-gray-800 transition">Batal</a>
        </div>
    </form>
    @error('title_tag')
    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
@endsection