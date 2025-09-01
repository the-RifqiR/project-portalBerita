<aside class="w-full md:w-1/4 bg-white rounded-xl shadow-md p-6">

    <div class="mb-6 border-b pb-4 text-center">
        <p class="text-gray-600 text-sm">Login sebagai:</p>
        <p class="text-lg font-semibold text-green-700">{{ Auth::user()->name }}</p>

        <form method="POST" action="{{ route('logout') }}" role="none">
            @csrf
            <button type="button"
                class="mt-3 block w-full text-sm font-medium px-4 py-2 rounded-lg text-red-600 border border-red-300 hover:bg-red-50 transition"
                onclick="showAlert(this.closest('form'))">
                Log out
            </button>
        </form>
    </div>

    <h3 class="text-lg font-bold mb-4 text-gray-700">Manajemen</h3>
    <ul class="space-y-2 text-sm">
        <li>
            <a href="@yield('list-route')"
                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition">
                <span>List</span>
            </a>
        </li>
        <li>
            <a href="@yield('create-route')"
                class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-green-50 hover:text-green-700 transition">
                <span>Create</span>
            </a>
        </li>
    </ul>
</aside>