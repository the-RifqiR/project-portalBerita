<nav class="mt-4">
    <div class="px-6">
        <div class="flex items-center flex-wrap gap-x-6 gap-y-2">
            <span class="text-sm font-bold text-green-900 pr-2">Kategori:</span>

            <div class="flex flex-wrap justify-center gap-x-6 gap-y-2 flex-grow">
                <a href="{{ route('index') }}"
                    class="px-4 py-1 rounded-lg text-sm font-semibold transition-colors duration-200
                    {{ !request('kategori') ? 'bg-green-800 text-white' : 'text-gray-600 hover:text-green-800' }}">
                    Home
                </a>

                @foreach($kategoriTerbaru as $kat)
                <a href="{{ route('index', ['kategori' => $kat->slug]) }}"
                    class="px-4 py-1 rounded-lg text-sm font-semibold transition-colors duration-200
                    {{ request('kategori') == $kat->slug ? 'bg-green-800 text-white' : 'text-gray-600 hover:text-green-800' }}">
                    {{ $kat->title }}
                </a>
                @endforeach

                <a href="{{ route('kategori.list') }}"
                    class="px-4 py-1 rounded-lg text-sm font-semibold transition-colors duration-200 text-gray-600 hover:text-orange-600">
                    Lihat lainnya
                </a>
            </div>
        </div>
    </div>
</nav>