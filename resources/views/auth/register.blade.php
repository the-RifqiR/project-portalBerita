<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Panel - Berita Kaltim</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-50 font-sans">

    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md mx-4">

        <h1 class="text-center text-2xl font-bold text-green-900 mb-8">LoginKan</h1>

        <form action="{{ route('register.log') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-2">EmailMu</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-gray-600 transition" />
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-2">PasswordMu</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-gray-600 transition" />
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700 font-semibold mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-gray-600 transition" />
            </div>

            <button type="submit"
                class="w-full bg-green-900 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition-shadow shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                Kirim
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600">
            Sudah punya akun? Langsung
            <a href="{{ route('login') }}" class="text-green-600 hover:underline hover:text-green-900 font-semibold">
                Login
            </a>
            aja sekarang
        </p>

    </div>
</body>

</html>