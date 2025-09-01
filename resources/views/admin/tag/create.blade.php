@extends('layouts.app')

@section('title', 'Manajemen Tag')
@section('list-route', route('tags.index'))
@section('create-route', route('tags.create'))

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 mb-8">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Tambah Tag Baru</h2>
    <form action="{{ route('tags.store') }}" method="POST" class="flex flex-col md:flex-row gap-4">
        @csrf
        <div class="flex-grow">
            <input type="text" name="title_tag" placeholder="Nama Tag" required
                class="w-full px-4 py-2 border-2 border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition" />
        </div>
        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md transition-shadow shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-700 w-full md:w-auto">
                Tambah
            </button>
        </div>
    </form>
    @error('title_tag')
    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
@endsection