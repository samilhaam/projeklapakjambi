@props(['header' => null])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pelaku UMKM Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white">

<div class="min-h-screen">
    @if ($header)
        <header class="bg-gray-800 shadow py-4 px-6 text-white text-xl font-bold">
            {{ $header }}
        </header>
    @endif

    {{ $slot }}
</div>

</body>
</html>
