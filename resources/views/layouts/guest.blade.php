<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Berita Kaltim')</title>
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

    <header class="bg-green-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-16 items-center">
                <div class="text-2xl font-bold tracking-wide">
                    <a href="{{ url('/') }}" class="hover:text-gray-300 transition duration-300">BeritaKaltim</a>
                </div>

                <nav class="flex items-center space-x-6 text-sm font-medium">
                    <a href="{{ url('/') }}" class="hover:text-gray-300">Beranda</a>
                    <a href="" class="hover:text-gray-300">Berita</a>
                    <a href="{{ url('/profil') }}" class="hover:text-gray-300">Profile/Contact</a>

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

    <div class="mt-4">
        <hr class="border-t border-green-800 opacity-20 my-6">
    </div>

    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

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

    // Fungsi untuk menampilkan popup dan menyimpan referensi form
    function showAlert(form) {
        currentForm = form;
        customAlert.classList.remove('hidden');
    }

    // Event listener untuk tombol 'Batal' di popup
    cancelBtn.addEventListener('click', () => {
        customAlert.classList.add('hidden');
        currentForm = null;
    });

    // Event listener untuk tombol 'Logout' di popup
    confirmBtn.addEventListener('click', () => {
        if (currentForm) {
            currentForm.submit(); // Kirim formulir yang disimpan
        }
        customAlert.classList.add('hidden');
    });
</script>

</html>