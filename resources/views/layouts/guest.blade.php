<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', ':Lapakjambi') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Scrollbar Styling -->
    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #1f2937; /* gray-800 */
        }
        ::-webkit-scrollbar-thumb {
            background-color: #6366f1; /* indigo-500 */
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background-color: #4f46e5; /* indigo-600 */
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-800 flex items-center justify-center p-4 overflow-y-auto max-h-screen">
  <div class="w-full max-w-lg bg-gray-900 rounded-2xl shadow-lg p-6">

    <h2 class="text-center text-2xl font-bold text-white">Daftar Akun Baru</h2>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <!-- Avatar -->
        <div>
            <label for="avatar" class="block text-sm font-medium text-gray-200">Foto Profil</label>
            <input type="file" name="avatar" id="avatar" class="mt-1 block w-full text-sm text-gray-300 file:bg-indigo-600 file:text-white file:rounded file:border-0 file:py-1 file:px-3 hover:file:bg-indigo-500" />
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-200">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="mt-1 w-full rounded-lg bg-slate-700 text-white border border-slate-600 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
            <input type="email" name="email" id="email" class="mt-1 w-full rounded-lg bg-slate-700 text-white border border-slate-600 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
        </div>

        <!-- Occupation -->
        <div>
            <label for="occupation" class="block text-sm font-medium text-gray-200">Pekerjaan</label>
            <input type="text" name="occupation" id="occupation" class="mt-1 w-full rounded-lg bg-slate-700 text-white border border-slate-600 px-4 py-2" />
        </div>

        <!-- Bank Name -->
        <div>
            <label for="bank_name" class="block text-sm font-medium text-gray-200">Nama Bank</label>
            <input type="text" name="bank_name" id="bank_name" class="mt-1 w-full rounded-lg bg-slate-700 text-white border border-slate-600 px-4 py-2" />
        </div>

        <!-- Bank Account -->
        <div>
            <label for="bank_account" class="block text-sm font-medium text-gray-200">Nomor Rekening</label>
            <input type="text" name="bank_account" id="bank_account" class="mt-1 w-full rounded-lg bg-slate-700 text-white border border-slate-600 px-4 py-2" />
        </div>

        <!-- Bank Account Number -->
        <div>
            <label for="bank_account_number" class="block text-sm font-medium text-gray-200">Ulangi No. Rekening</label>
            <input type="text" name="bank_account_number" id="bank_account_number" class="mt-1 w-full rounded-lg bg-slate-700 text-white border border-slate-600 px-4 py-2" />
        </div>

        <!-- Pilihan Role -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-200">Daftar Sebagai</label>
            <select name="role" id="role" class="mt-1 w-full rounded-lg bg-slate-700 text-white border border-slate-600 px-4 py-2" required>
                <option value="">-- Pilih Role --</option>
                <option value="pembeli">Pembeli</option>
                <option value="pelaku_umkm">Pelaku UMKM</option>
            </select>
            @error('role')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
            <input type="password" name="password" id="password" class="mt-1 w-full rounded-lg bg-slate-700 text-white border border-slate-600 px-4 py-2" required />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-200">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 w-full rounded-lg bg-slate-700 text-white border border-slate-600 px-4 py-2" required />
        </div>

        <!-- Submit -->
        <div>
            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                Register
            </button>
        </div>
    </form>

    <!-- Link ke Login -->
    <div class="text-center text-sm text-gray-300 mt-4">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">Login di sini</a>
    </div>

  </div>
</body>
</html>
<!--register view--->
