@extends('layouts.app')

@section('title', 'Manajemen Kategori')
@section('list-route', route('kategori.index'))
@section('create-route', route('kategori.create'))

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-6 space-y-4 md:space-y-0">
    <h1 class="text-3xl font-bold text-gray-800">Manajemen Kategori</h1>
</div>

@if (session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
    {{ session('success') }}
</div>
@endif


<!-- Tabel Daftar Kategori -->
<div class="bg-white rounded-xl shadow-lg p-6 overflow-x-auto">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Kategori</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    No
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nama Kategori
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Tags Terkait
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Aksi
                </th>
            </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
            @php
            $no = 1;
            @endphp
            @forelse ($categories as $category)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{$no++;}}
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('kategori.show', $category) }}" class="text-blue-600 hover:underline">{{ $category->title }}</a>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{ $category->tags->pluck('title_tag')->join(', ') }}
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('kategori.edit', $category) }}" class="text-green-600 hover:text-green-900 transition duration-300">
                        Edit
                    </a>

                    <form action="{{ route('kategori.destroy', $category) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');" class="inline-block ml-2">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 transition duration-300">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                    Belum ada kategori yang ditambahkan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection