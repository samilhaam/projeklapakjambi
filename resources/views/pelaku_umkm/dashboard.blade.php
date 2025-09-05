<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard Pelaku UMKM') }}
        </h2>
    </x-slot>

    <div class="flex flex-col md:flex-row min-h-[calc(100vh-4rem)] w-full bg-gradient-to-br from-gray-900 to-gray-800 overflow-x-hidden">
        
        {{-- SIDEBAR --}}
        <aside class="fixed left-0 top-16 h-[calc(100vh-4rem)] w-60 lg:w-64 bg-gray-900 border-r border-gray-700 p-4 lg:p-6 hidden md:block z-40">
            <h2 class="text-2xl font-bold mb-10 text-white">Pelaku UMKM Panel</h2>
            <nav class="space-y-3">
                <a href="{{ route('pelaku_umkm.dashboard') }}" class="block text-lg px-4 py-2 rounded hover:bg-gray-700 text-white {{ request()->is('pelaku-umkm/dashboard') ? 'bg-gray-700' : '' }}">📊 Dashboard</a>
                <a href="{{ route('pelaku_umkm.products.index') }}" class="block text-lg px-4 py-2 rounded hover:bg-gray-700 text-white {{ request()->is('pelaku-umkm/products') ? 'bg-gray-700' : '' }}">📦 My Products</a>
                <a href="{{ route('pelaku_umkm.orders.index') }}" class="block text-lg px-4 py-2 rounded hover:bg-gray-700 text-white {{ request()->is('pelaku-umkm/orders') ? 'bg-gray-700' : '' }}">📃 My Orders</a>
                <a href="{{ route('pelaku_umkm.transactions') }}" class="block text-lg px-4 py-2 rounded hover:bg-gray-700 text-white {{ request()->is('pelaku-umkm/transactions') ? 'bg-gray-700' : '' }}">💰 My Transactions</a>
                <a href="/" class="block text-lg px-4 py-2 rounded hover:bg-gray-700 text-white">🏠 Home</a>
            </nav>

            <div class="mt-10 pt-6 border-t border-gray-700">
                <p class="text-white font-semibold mb-2">{{ Auth::user()->name }}</p>
                <a href="{{ route('profile.edit') }}" class="block w-full text-left bg-blue-500 text-white px-4 py-2 mb-2 rounded hover:bg-blue-600">
                    👤 Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        🔓 Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-4 md:p-8 overflow-y-auto md:ml-64">
            <div class="max-w-screen-xl mx-auto w-full">
            <h1 class="text-3xl font-bold mb-8 text-white">Selamat Datang, {{ Auth::user()->name }} 👋</h1>

            {{-- Statistik Produk --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-white/10 p-6 rounded-xl shadow text-center hover:scale-105 transition">
                    <div class="text-4xl mb-2">📦</div>
                    <p class="text-sm text-gray-300">Total Produk</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ count($products ?? []) }}</p>
                </div>
                <div class="bg-white/10 p-6 rounded-xl shadow text-center hover:scale-105 transition">
                    <div class="text-4xl mb-2">✅</div>
                    <p class="text-sm text-gray-300">Total Orders</p>
                    <p class="text-3xl font-bold text-white mt-1">{{ $totalOrders ?? 0 }}</p>
                </div>
                <div class="bg-white/10 p-6 rounded-xl shadow text-center hover:scale-105 transition">
                    <div class="text-4xl mb-2">💰</div>
                    <p class="text-sm text-gray-300">Total Pendapatan</p>
                    <p class="text-3xl font-bold text-white mt-1">Rp {{ number_format($totalRevenue ?? 0) }}</p>
                </div>
                <div class="bg-white/10 p-6 rounded-xl shadow text-center hover:scale-105 transition">
                    <div class="text-4xl mb-2">📈</div>
                    <p class="text-sm text-gray-300">Rata-rata per Order</p>
                    <p class="text-3xl font-bold text-white mt-1">Rp {{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders) : 0 }}</p>
                </div>
            </div>

            {{-- Produk Terbaru --}}
            @if(count($products ?? []) > 0)
                <div class="bg-white/10 p-4 md:p-6 rounded-lg shadow mb-6">
                    <h2 class="text-xl font-bold mb-4 text-white">📦 Produk Terbaru</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($products->take(3) as $product)
                            <div class="bg-gray-800 rounded-lg p-3 md:p-4 border border-gray-700">
                                <img src="{{ \App\Helpers\ImageHelper::getProductCoverUrl($product) }}" alt="{{ $product->name }}" class="w-full h-28 md:h-32 object-cover rounded mb-3">
                                <h3 class="text-white font-semibold mb-2">{{ $product->name }}</h3>
                                <p class="text-yellow-500 font-bold">Rp {{ number_format($product->price) }}</p>
                                <a href="{{ route('pelaku_umkm.products.edit', $product) }}" class="text-blue-400 hover:text-blue-300 text-sm">Edit Product</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Chart --}}
            <div class="bg-white/10 p-4 md:p-6 rounded-lg shadow">
                <h2 class="text-xl font-bold mb-4 text-white">📈 Grafik Pendapatan</h2>
                <canvas id="revenueChart" class="w-full max-h-[380px] md:max-h-[420px]"></canvas>
            </div>
            </div>
        </main>
    </div>

    {{-- Chart Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Pendapatan',
                    data: [100000, 120000, 180000, 90000, 150000, 200000],
                    backgroundColor: 'rgba(99, 102, 241, 0.2)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
