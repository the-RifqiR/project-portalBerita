<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Berita - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans antialiased">

    @include('layouts.header')

    <main class="container mx-auto p-6 flex flex-col md:flex-row gap-6">

        @include('layouts.sidebar')

        <div class="w-full md:w-3/4 bg-white rounded-xl shadow-md p-6">
            @yield('content')
        </div>
    </main>

    <div id="custom-alert" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden flex justify-center items-center p-4 z-50">
        <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-sm text-center">
            <h3 class="text-xl font-bold mb-4 text-gray-800">Konfirmasi Logout</h3>
            <p class="text-gray-600 mb-6">Apakah Anda yakin ingin keluar dari akun?</p>
            <div class="flex justify-center space-x-4">
                <button id="cancel-btn" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg">
                    Batal
                </button>
                <button id="confirm-btn" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg">
                    Logout
                </button>
            </div>
        </div>
    </div>

    @yield('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#deskripsi').summernote({
                placeholder: 'Tulis isi artikel berita di sini...',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

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
            if (currentForm) currentForm.submit();
            customAlert.classList.add('hidden');
        });
    </script>

</body>

</html>