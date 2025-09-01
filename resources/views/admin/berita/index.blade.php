@extends('layouts.app')

@section('title', 'Manajemen Berita')
@section('list-route', route('berita.dashboard'))
@section('create-route', route('berita.formCreate'))

@section('content')
<h1 class="text-2xl font-bold mb-6 text-gray-800">Daftar Berita</h1>

<div class="w-full overflow-x-auto">
    <table class="bg-white rounded-lg min-w-full table-auto shadow divide-y divide-gray-200">
        <thead class="bg-green-900 text-white">
            <tr>

                <th class="font-semibold text-left text-xs md:text-sm px-4 py-2">No</th>
                <th class="font-semibold text-left text-xs md:text-sm px-4 py-2">Judul</th>
                <th class="font-semibold text-left text-xs md:text-sm px-4 py-2">Thumbnail</th>
                <th class="font-semibold text-left text-xs md:text-sm px-4 py-2 hidden md:table-cell">Deskripsi</th>
                <th class="font-semibold text-left text-xs md:text-sm px-4 py-2 hidden sm:table-cell">Slug</th>
                <th class="font-semibold text-left text-xs md:text-sm px-4 py-2 lg:table-cell">Tags</th>
                <th class="font-semibold text-left text-xs md:text-sm px-4 py-2 lg:table-cell">Kategori</th>
                <th class="font-semibold text-left text-xs md:text-sm px-4 py-2 hidden lg:table-cell">Penulis</th>
                <th class="font-semibold text-left text-xs md:text-sm px-4 py-2">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
            @php $no = 1; @endphp
            @foreach ($userBerita as $news)
            <tr class="hover:bg-gray-50">
                <td class="text-xs px-4 py-2 md:text-sm align-top">{{ $no++ }}</td>

                <td class="text-xs px-4 py-2 md:text-sm font-medium text-gray-900 align-top break-words">
                    {{ $news->judul }}
                </td>

                <td class="text-xs px-4 py-2 md:text-sm align-top">
                    @if($news->image)
                    <img src="{{ asset($news->image) }}" alt="{{ $news->judul }}"
                        class="w-24 h-16 md:w-28 md:h-20 rounded object-cover" />
                    @else
                    <span class="text-gray-400 italic">Tidak ada gambar</span>
                    @endif
                </td>


                <td class="text-xs px-4 py-2 md:text-sm max-w-[16rem] text-gray-700 hidden md:table-cell align-top break-words">
                    @php
                    $plain = trim(strip_tags($news->deskripsi));
                    $firstParagraph = preg_split("/\r\n|\n|\r/", $plain)[0] ?? '';
                    $halfLen = (int) floor(strlen($firstParagraph) / 2);
                    @endphp
                    <a href="#" title="Baca deskripsi lengkap" class="hover:underline">
                        {{ $halfLen > 0 ? Str::limit($firstParagraph, $halfLen, '...') : Str::limit($plain, 80, '...') }}
                    </a>
                </td>

                <td class="text-xs px-4 py-2 md:text-sm hidden sm:table-cell align-top break-words">
                    {{ $news->slug_berita }}
                </td>

                <td class="text-xs px-4 py-2 md:text-sm lg:table-cell align-top">
                    <div class="flex flex-wrap gap-1">
                        @forelse ($news->tags as $tag)
                        <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-[10px] md:text-xs font-semibold text-gray-700">
                            {{ $tag->title_tag }}
                        </span>
                        @empty
                        <span class="text-gray-400 italic">-</span>
                        @endforelse
                    </div>
                </td>

                <td class="text-xs px-4 py-2 md:text-sm lg:table-cell align-top">
                    {{ $news->kategori->title ?? '-' }}
                </td>

                <td class="text-xs px-4 py-2 md:text-sm hidden lg:table-cell align-top">
                    {{ Auth::user()->name }}
                </td>


                <td class="text-xs px-4 py-2 md:text-sm align-top">
                    <div class="flex flex-col xs:flex-row gap-2">
                        <a href="{{ route('berita.formEdit', ['id' => $news->id]) }}"
                            class="inline-block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-1 px-3 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-700">
                            Edit
                        </a>

                        <form action="{{ route('berita.deleteData', ['id' => $news->id]) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full xs:w-auto bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded-full transition-shadow shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-700">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
