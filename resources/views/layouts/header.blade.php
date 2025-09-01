<header class="bg-green-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-16 items-center">
            <div class="text-2xl font-bold tracking-wide">
                <a href="{{ url('/') }}" class="hover:text-gray-300 transition duration-300">BeritaKaltim</a>
            </div>

            <nav class="flex items-center space-x-6 text-sm font-medium">
                <a href="{{ url('/') }}" class="hover:text-gray-300">Beranda</a>
                <a href="#" class="hover:text-gray-300">Berita</a>
                <a href="{{ url('/profil') }}" class="hover:text-gray-300">Profile/Contact</a>
            </nav>
        </div>
    </div>
</header>

<nav class="bg-white shadow border-b border-gray-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-end h-12 items-center space-x-6 text-sm font-semibold pr-6 lg:pr-12">
            <a href="{{ route('tags.index') }}" class="transition duration-200 {{ request()->routeIs('tags.*') ? 'text-green-700 border-b-2 border-green-700' : 'hover:text-green-700' }}">Tag</a>
            <span class="text-gray-300">|</span>
            <a href="{{ route('kategori.index') }}" class="transition duration-200 {{ request()->routeIs('kategori.*') ? 'text-green-700 border-b-2 border-green-700' : 'hover:text-green-700' }}">Kategori</a>
            <span class="text-gray-300">|</span>
            <a href="{{ route('berita.dashboard') }}"
                class="transition duration-200 {{ request()->routeIs('berita.*') ? 'text-green-700 border-b-2 border-green-700' : 'hover:text-green-700' }}">
                Berita
            </a>
        </div>
    </div>
</nav>