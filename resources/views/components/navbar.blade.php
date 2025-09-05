<nav class="w-full fixed top-0 bg-[#0f0f0f66] backdrop-blur-md z-50 shadow-md transition-all duration-300">
    <div class="container max-w-[1130px] mx-auto flex items-center justify-between h-[74px] px-4">
        <!-- Logo & Menu -->
        <div class="flex items-center gap-8">
            <a href="{{ route('front.index') }}" class="flex items-center text-white font-bold text-2xl">
                <span class="text-white">Lapakjmb<span class="text-purple-400">    
                    .id</span></span>
            </a>

            <!-- Menu -->
            <ul class="hidden md:flex gap-6 items-center text-sm">
                <li>
                    <a href="{{ route('front.index') }}"
                        class="text-gray-300 hover:text-white transition duration-300">Home</a>
                </li>
                <li>
                    <a href="{{ route('front.about') }}"
                        class="text-gray-300 hover:text-white transition duration-300">About</a>
                </li>
            </ul>
        </div>

        <!-- Auth -->
        <div class="flex gap-4 items-center text-sm">
            @guest
                <a href="{{ route('login') }}"
                    class="text-gray-300 hover:text-white transition duration-300">Log in</a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 rounded-xl border border-gray-600 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-300">Sign
                    up</a>
            @endguest

            @auth
                @php
                    $user = Auth::user();
                    $dashboardRoute = '';
                    $dashboardText = '';
                    
                    if ($user->role === 'admin') {
                        $dashboardRoute = 'admin.dashboard';
                        $dashboardText = 'Admin Dashboard';
                    } elseif ($user->role === 'pelaku_umkm') {
                        $dashboardRoute = 'pelaku_umkm.dashboard';
                        $dashboardText = 'UMKM Dashboard';
                    } elseif ($user->role === 'pembeli') {
                        $dashboardRoute = 'pembeli.dashboard';
                        $dashboardText = 'pembeli';
                    }
                @endphp
                
                @if($dashboardRoute)
                    <a href="{{ route($dashboardRoute) }}"
                        class="px-4 py-2 rounded-xl border border-gray-600 text-gray-300 hover:bg-gray-700 hover:text-white transition-all duration-300">
                        {{ $dashboardText }}
                    </a>
                @endif
                
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 rounded-xl border border-gray-600 text-gray-300 hover:bg-red-700 hover:text-white transition-all duration-300">
                        Sign Out
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>
