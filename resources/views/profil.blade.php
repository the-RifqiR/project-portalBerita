@extends('layouts.guest')

@section('title', 'Profil & Kontak')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 md:p-12 mt-8 mb-8">
    <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">

        <div class="flex-shrink-0">
            <img class="h-48 w-48 object-cover rounded-full border-4 border-green-500"
                src="{{ asset('storage/IMG20250810204638.jpg') }}" alt="Foto Profil">
        </div>

        <div class="text-center md:text-left">
            <h1 class="text-3xl font-bold text-gray-800">Nama Lengkap Anda</h1>
            <p class="text-lg text-gray-600 mt-1">Pengembang Web / Kontributor Berita</p>
            <hr class="my-4 border-gray-300">

            <div class="space-y-2 text-gray-700 text-sm md:text-base">
                <p>
                    <span class="font-semibold text-green-700">Bio:</span>
                    Seorang pengembang web yang tertarik pada pembuatan game, teknologi dan pembuatan web.
                    Saat ini fokusnya untuk belajar bertahap dan mulai pada pengembangan situs berita belajar menggunakan framework dari bahasa PHP.
                    Tertarik pada teknologi, proses pembuatan, <em>clean code</em>, dan logika yang kompleks.
                </p>
                <p>
                    <span class="font-semibold text-green-700">Email:</span>
                    <a href="mailto:email@contoh.com" class="text-blue-600 hover:underline">rifqi00f@gmail.com</a>
                </p>
                <p>
                    <span class="font-semibold text-green-700">Lokasi:</span>
                    Di situ, Kalimantan Timurs
                </p>
            </div>

            <div class="mt-6 flex justify-center md:justify-start space-x-4">
                <a href="https://github.com/username" target="_blank" class="text-gray-500 hover:text-green-700 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.83 9.504.5.092.682-.217.682-.483 0-.237-.008-.853-.013-1.67-.83-.16-1.6-.401-1.928-.96.186-.447-.41-.958-.823-1.226-.184-.13-.44-.196-.6-.226-.407-.15-.992-.375-.015-.382.784-.006 1.197.804 1.378 1.25.748 1.298 1.942.923 2.417.705.075-.546.29-.923.53-1.13-1.85-.202-3.8-2.583-3.8-5.786 0-.96.347-1.748.918-2.365-.092-.202-.4-1.127.087-2.352 0 0 .75-.24 2.455.91A8.448 8.448 0 0112 5.688c.773 0 1.554.103 2.296.304 1.706-1.15 2.456-.91 2.456-.91.488 1.225.178 2.15.087 2.352.57.617.918 1.405.918 2.365 0 3.212-1.95 5.584-3.808 5.78.29.25.546.732.546 1.48 0 1.07-.01 1.933-.01 2.193 0 .26.18.577.688.483C19.143 20.2 22 16.445 22 12.017 22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="https://linkedin.com/in/username" target="_blank" class="text-gray-500 hover:text-green-700 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.765 0-.975.784-1.765 1.75-1.765s1.75.79 1.75 1.765c0 .975-.784 1.765-1.75 1.765zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.58 7-2.76 7 2.657v6.578z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection