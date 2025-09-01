@extends('layouts.app')

@section('title', 'Manajemen Tag')
@section('list-route', route('tags.index'))
@section('create-route', route('tags.create'))

@section('content')
@if (session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow-lg p-6 overflow-x-auto">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Daftar Tag</h2>
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    No
                </th>

                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nama Tag
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
            @forelse ($tags as $tag)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $no++ }}
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                    {{ $tag->title_tag }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('tags.edit', $tag) }}" class="text-green-600 hover:text-green-900 transition duration-300">
                        Edit
                    </a>

                    <form action="{{ route('tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');" class="inline-block ml-2">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 transition duration-300">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                    Belum ada tag yang ditambahkan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection