@extends('layouts.app')

@section('title', 'Buat Berita Baru')
@section('list-route', route('berita.dashboard'))
@section('create-route', route('berita.create'))

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
    <h1 class="text-3xl font-bold text-gray-800">Formulir Berita Baru</h1>
</div>

@if (session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('berita.create') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    <!-- Judul Berita -->
    <div>
        <label for="judul" class="block mb-2 font-semibold text-gray-700">Judul Berita</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
            class="w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-gray-600 transition" />
        @error('judul')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Pilihan Kategori -->
    <div>
        <label for="kat" class="block mb-2 font-semibold text-gray-700">Kategori</label>
        <select name="kategori" id="kat"
            class="w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-green-600 transition">
            <option value="">Pilih Kategori</option>
            @foreach ($kategoris as $kat)
            <option value="{{ $kat->id }}" {{ old('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->title }}</option>
            @endforeach
        </select>
        @error('kategori')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Pilihan Tag -->
    <div id="tag-container">
        <label class="block mb-2 font-semibold text-gray-700">Pilih Tag:</label>
        <div id="tag-checkboxes" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            
        </div>
    </div>

    <!-- Thumbnail -->
    <div>
        <label for="image" class="block mb-2 font-semibold text-gray-700">Thumbnail</label>
        <input type="file" name="image" id="image"
            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 transition cursor-pointer" />
        @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Isi Berita -->
    <div>
        <label for="deskripsi" class="block mb-2 font-semibold text-gray-700">Isi Berita</label>
        <textarea name="deskripsi" id="deskripsi" rows="5" required
            class="w-full px-4 py-2 border-2 border-green-300 rounded-md resize-y focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition">{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Tombol Submit -->
    <div class="text-center">
        <button type="submit"
            class="bg-green-900 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-full transition-shadow shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-700">
            Buat Berita
        </button>
    </div>
</form>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategoriSelect = document.getElementById('kat');
        const tagContainer = document.getElementById('tag-checkboxes');

        kategoriSelect.addEventListener('change', function() {
            const kategoriId = this.value;

            tagContainer.innerHTML = '';

            if (!kategoriId) return;

            // Mengambil tag sesuai kategori
            fetch(`/kategori/${kategoriId}/tags`)
                .then(res => res.json())
                .then(tags => {
                    tags.forEach(tag => {
                        const label = document.createElement('label');
                        label.classList.add('flex', 'items-center', 'space-x-2', 'cursor-pointer');

                        label.innerHTML = `
                        <input type="checkbox" name="tags[]" value="${tag.id}"
                               class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <span class="text-gray-900 text-sm">${tag.title_tag}</span>
                    `;

                        tagContainer.appendChild(label);
                    });
                })
                .catch(err => console.error('Error:', err));
        });
    });
</script>
@endsection