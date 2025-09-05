<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LapakJambi - Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white">
    <div class="min-h-screen flex flex-col">
        {{-- Header --}}
        <header class="bg-gray-800 shadow p-4">
            <div class="max-w-7xl mx-auto">
                {{ $header }}
            </div>
        </header>

        {{-- Konten --}}
        <main class="flex-1">
            {{ $slot }}
        </main>
    </div>
</body>
</html>
