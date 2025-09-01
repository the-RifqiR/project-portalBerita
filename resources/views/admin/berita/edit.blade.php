@extends('layouts.app')

@section('title', 'Edit Berita')
@section('list-route', route('berita.dashboard'))
@section('create-route', route('berita.create'))

@section('content')
<form action=" {{ route('berita.update', ['id' => $berita->id]) }} " method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Judul -->
    <div>
        <label for="judul" class="block mb-2 font-semibold text-gray-700">Judul Berita</label>

        <input type="text" name="judul" id="judul" value="{{ old('judul', $berita->judul) }}" required
            class="w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-gray-600 transition" />
        @error('judul')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    <!-- Kategori -->
    <div>
        <label for="kat" class="block mb-2 font-semibold text-gray-700">Kategori</label>

        <select name="kategori" id="kat" class="w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-gray-600 transition">
            <option value="">Pilih Kategori</option>
            @foreach ($kategoris as $kat)

            <option value="{{ $kat->id }}" {{ old('kategori', $berita->id_kat) == $kat->id ? 'selected' : '' }}>{{ $kat->title }}</option>

            @endforeach
        </select>

        @error('kategori')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    <!-- Tag -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">Pilih Tag:</label>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($tags as $tag)
            <label for="tag_{{ $tag->id }}" class="flex items-center space-x-2 cursor-pointer">

                <input type="checkbox" name="tags[]" id="tag_{{ $tag->id }}" value="{{ $tag->id }}"
                    class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                    {{ in_array($tag->id, old('tags', $tagsLainnya)) ? 'checked' : '' }} />
                <span class="text-gray-900 text-sm">{{ $tag->title_tag }}</span>

            </label>
            @endforeach
        </div>

        @error('tags')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
        @error('tags.*')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    <!-- Image -->
    <div>
        <label for="image" class="block mb-2 font-semibold text-gray-700">Thumbnail</label>

        @if ($berita->image)
        <div class="mb-2">

            <p class="text-sm text-gray-500">Gambar saat ini:</p>
            <img src="{{  asset($berita->image) }}" alt="Gambar thumbnail berita" class="w-32 h-32 object-cover rounded-md border-2 border-gray-300">

        </div>
        @endif

        <input type="file" name="image" id="image"
            class="block w-full text-gray-500 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 transition cursor-pointer" />
        @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    <!-- Deskripsi -->
    <div>
        <label for="deskripsi" class="block mb-2 font-semibold text-gray-700">Isi Berita</label>
        <textarea name="deskripsi" id="deskripsi" rows="5" required
            class="w-full px-4 py-2 border-2 border-green-300 rounded-md resize-y focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 transition">{{ old('deskripsi', $berita->deskripsi) }}</textarea>
        @error('deskripsi')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    <div class="text-center">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full transition-shadow shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-700">
            Update Berita
        </button>
    </div>

</form>


@endsection