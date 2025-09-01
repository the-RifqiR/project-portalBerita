    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Berita Kaltim</title>
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .line-clamp-3 {
                overflow: hidden;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 3;
            }
        </style>
    </head>

    <body class="bg-gray-50 font-sans antialiased">

        <!-- Header -->
        <header class="bg-green-900 text-white shadow-md">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex justify-between h-16 items-center">
                    <!-- Logo -->
                    <div class="text-2xl font-bold tracking-wide">
                        <a href="{{ url('/') }}" class="hover:text-gray-300 transition duration-300">BeritaKaltim</a>
                    </div>

                    <!-- Navbar utama -->
                    <nav class="flex items-center space-x-6 text-sm font-medium">
                        <a href="{{ url('/') }}" class="hover:text-gray-300">Beranda</a>
                        <a href="" class="hover:text-gray-300">Berita</a>
                        <a href="{{ url('/profil') }}" class="hover:text-gray-300">Profile/Contact</a>

                        <!-- Nav khusus user login -->
                        @auth
                        <div x-data="{ open: false }" class="relative inline-block text-left">
                            <button @click="open = !open" type="button"
                                class="inline-flex items-center hover:text-gray-300 font-medium focus:outline-none">
                                Akun
                                <svg class="ml-2 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.584l3.71-4.353a.75.75 0 011.14.976l-4.25 5a.75.75 0 01-1.14 0l-4.25-5a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" x-cloak @click.away="open = false" role="menu" aria-orientation="vertical"
                                tabindex="-1"
                                class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-20">

                                <div class="py-1" role="none">
                                    <div class="px-4 py-2 text-sm text-gray-700 border-b">
                                        Masuk sebagai <br />
                                        <span class="font-semibold text-green-700">{{ auth()->user()->email }}</span>
                                    </div>

                                    <a href="{{route('berita.dashboard')}}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                                        tabindex="-1">Halaman Kreator</a>

                                    <form method="POST" action="{{ route('logout') }}" role="none" tabindex="-1">
                                        @csrf
                                        <button type="button"
                                            class="block w-full text-left text-sm px-4 py-2 text-red-600 hover:bg-gray-100"
                                            onclick="showAlert(this.closest('form'))">
                                            Sign out
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>
                        @endauth
                        <!-- Nav khusus user login end -->

                        @guest
                        <a href="{{ route('login') }}"
                            class="text-white font-semibold py-2 px-4 rounded-full hover:border-orange-500 hover:bg-orange-600 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </a>
                        @endguest

                    </nav>
                </div>
            </div>
        </header>

        @include('layouts.nav-kategori')

        <div class="mt-4">
            <hr class="border-t border-green-800 opacity-20 my-6">
        </div>

        <main class="container mx-auto p-8">
            <h1 class="text-4xl font-bold mb-8 text-gray-800 text-center">Berita Terbaru dari Kalimantan Timur</h1>

            @if($berita->isEmpty())
            <p class="text-center text-gray-600 text-lg">Belum ada berita yang tersedia saat ini.</p>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($berita as $item)

                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                    @if($item->image)
                    <img src="{{asset($item->image) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                        Tidak ada gambar
                    </div>
                    @endif

                    <div class="p-6">
                        <div class="text-xs font-semibold uppercase text-green-800 bg-green-100 inline-block px-2 py-1 rounded-full mb-3">
                            {{ $item->kategori->title ?? 'Tanpa Kategori' }}
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2 leading-tight">{{ $item->judul }}</h2>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($item->deskripsi), 150) }}
                        </p>
                        <div class="mb-4 flex flex-wrap gap-1">
                            @forelse($item->tags as $tag)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700">
                                {{ $tag->title_tag }}
                            </span>
                            @empty
                            @endforelse
                        </div>
                        <a href="{{ route('berita.show', $item->slug_berita) }}" class="inline-block bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-5 rounded-full text-sm transition duration-300">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>

                @endforeach
            </div>

            <div class="mt-12 flex justify-center">

            </div>
            @endif
        </main>


        <!-- Alert Login atau Register -->
        @if(session('login_success') || session('register_success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 30000)" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md px-4">
            <div class="flex items-center justify-between bg-green-50 border border-green-400 text-green-800 px-4 py-3 rounded-lg relative shadow-md" role="alert">
                <span class="block text-sm sm:inline">{{ session('login_success') ?? session('register_success') }}</span>
                <button @click="show = false" class="ml-4 text-green-700 hover:text-green-900 focus:outline-none">
                    <svg class="fill-current h-5 w-5" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 001.414 1.414L10 12.828l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934z" />
                    </svg>
                </button>
            </div>
        </div>
        @endif
        <!-- Alert Login atau Register End-->


        <!-- Popup Log-out -->
        <div id="custom-alert" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden flex justify-center items-center p-4 z-50">
            <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-sm text-center">
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Konfirmasi Logout</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin keluar dari akun?</p>
                <div class="flex justify-center space-x-4">
                    <button id="cancel-btn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition duration-300">
                        Batal
                    </button>
                    <button id="confirm-btn" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        Logout
                    </button>
                </div>
            </div>
        </div>
        <!-- Popup Log-out End -->


    </body>

    <script>
        const customAlert = document.getElementById('custom-alert');
        const confirmBtn = document.getElementById('confirm-btn');
        const cancelBtn = document.getElementById('cancel-btn');

        let currentForm = null;


        function showAlert(form) {
            currentForm = form;
            customAlert.classList.remove('hidden');
        }


        cancelBtn.addEventListener('click', () => {
            customAlert.classList.add('hidden');
            currentForm = null;
        });


        confirmBtn.addEventListener('click', () => {
            if (currentForm) {
                currentForm.submit();
            }
            customAlert.classList.add('hidden');
        });
    </script>

    </html>