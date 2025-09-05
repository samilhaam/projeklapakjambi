<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS Utama -->
    @stack('before-style')
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">

    <!-- Tailwind via CDN (boleh hapus jika sudah di-compile via Vite) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'lapakjmb-black': '#0f0f0f',
                    }
                }
            }
        }
    </script>

    <!-- Font dan Flickity -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

    <title>@yield('title')</title>
    @stack('after-style')
</head>

<body class="min-h-screen w-full overflow-x-hidden bg-belibang-black font-poppins text-white">
    @yield('content')

    @stack('before-script')

    <!-- JS: jQuery & Flickity -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    @stack('after-script')
</body>

</html>
