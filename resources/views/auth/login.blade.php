<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - LapakJambi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-900 to-slate-700 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-8 bg-slate-800 rounded-2xl shadow-2xl text-white">
        <!-- Logo -->
        <div class="flex justify-center mb-8">
            <div class="relative">
                <img src="/images/logos/logolapakjambi.svg" alt="LapakJambi Logo" class="h-20 w-auto rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                <!-- Subtle glow effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500/20 to-indigo-500/20 rounded-xl blur-sm"></div>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-center mb-6 text-gray-100">Masuk ke lapak jambi.id</h2>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-500">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm mb-1 text-gray-300">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 text-white placeholder-gray-400" 
                    placeholder="Masukkan email Anda" />
                @error('email')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm mb-1 text-gray-300">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 text-white placeholder-gray-400" 
                    placeholder="Masukkan password Anda" />
                @error('password')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center text-gray-300">
                    <input type="checkbox" name="remember" class="accent-indigo-500 rounded">
                    <span class="ml-2">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-indigo-400 hover:text-indigo-300 hover:underline transition-colors duration-200">Lupa password?</a>
                @endif
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-3 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                Masuk
            </button>

            <!-- Register -->
            <p class="text-sm text-center mt-6 text-gray-400">
                Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 hover:underline transition-colors duration-200 font-medium">Daftar di sini</a>
            </p>

        </form>
    </div>

</body>
</html>
