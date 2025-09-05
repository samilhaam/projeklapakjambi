@extends('layouts.admin')

@section('content')
<!-- Header with gradient -->
<header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-2xl border-b border-gray-700 mb-4 compact-header">
    <div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-2">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="p-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-md shadow-lg">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-lg font-bold text-white">Admin Dashboard</h1>
                    <p class="text-gray-400 text-sm">Marketplace Management</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <p class="text-white font-medium text-sm">Admin UMKM</p>
                    <p class="text-gray-400 text-sm">{{ now()->format('l, F j, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6">
<!-- Statistics Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6 compact-cards">
            <!-- Total Users -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-3 shadow-lg transform hover:scale-[1.02] transition-all duration-300 compact-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-blue-100 text-xs font-medium">Total Users</p>
                        <p class="text-2xl font-bold text-white compact-number">{{ $totalUsers }}</p>
                        <p class="text-blue-200 text-xs mt-1">+{{ $totalUsers }} this week</p>
                    </div>
                    <div class="p-2 bg-white bg-opacity-20 rounded-md ml-2 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-3 shadow-lg transform hover:scale-[1.02] transition-all duration-300 compact-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-green-100 text-xs font-medium">Total Products</p>
                        <p class="text-2xl font-bold text-white compact-number">{{ $totalProducts }}</p>
                        <p class="text-green-200 text-xs mt-1">{{ $totalProducts }} total</p>
                    </div>
                    <div class="p-2 bg-white bg-opacity-20 rounded-md ml-2 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-3 shadow-lg transform hover:scale-[1.02] transition-all duration-300 compact-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-yellow-100 text-xs font-medium">Total Orders</p>
                        <p class="text-2xl font-bold text-white compact-number">{{ $totalOrders }}</p>
                        <p class="text-yellow-200 text-xs mt-1">+{{ $totalOrders }} this week</p>
                    </div>
                    <div class="p-2 bg-white bg-opacity-20 rounded-md ml-2 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-3 shadow-lg transform hover:scale-[1.02] transition-all duration-300 compact-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-purple-100 text-xs font-medium">Total Revenue</p>
                        <p class="text-2xl font-bold text-white compact-number">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                        <p class="text-purple-200 text-xs mt-1">+{{ number_format($totalRevenue, 0, ',', '.') }} this week</p>
                    </div>
                    <div class="p-2 bg-white bg-opacity-20 rounded-md ml-2 flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- User Distribution -->
            <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700">
                <div class="px-3 py-2 border-b border-gray-700">
                    <h3 class="text-sm font-bold text-white">User Distribution</h3>
                </div>
                <div class="p-3">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                                <span class="text-xs text-gray-300">Pelaku UMKM</span>
                            </div>
                            <span class="text-xs font-medium text-white">{{ $usersByRole['pelaku_umkm'] ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-xs text-gray-300">Pembeli</span>
                            </div>
                            <span class="text-xs font-medium text-white">{{ $usersByRole['pembeli'] ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                <span class="text-xs text-gray-300">Admin</span>
                            </div>
                            <span class="text-xs font-medium text-white">{{ $usersByRole['admin'] ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700">
                <div class="px-3 py-2 border-b border-gray-700">
                    <h3 class="text-sm font-bold text-white">Recent Orders</h3>
                </div>
                <div class="p-3">
                    <div class="space-y-2">
                        @forelse($recentOrders as $order)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mr-2">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-white">{{ $order->product->name ?? 'Product Deleted' }}</p>
                                    <p class="text-xs text-gray-400">{{ $order->buyer->name ?? 'User Deleted' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-medium text-white">Rp {{ number_format($order->product->price ?? 0, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-2">
                            <p class="text-xs text-gray-400">No recent orders</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700">
                <div class="px-3 py-2 border-b border-gray-700">
                    <h3 class="text-sm font-bold text-white">Top Products</h3>
                </div>
                <div class="p-3">
                    <div class="space-y-2">
                        @forelse($topProducts as $product)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mr-2">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-white">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $product->creator->name ?? 'Unknown' }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-medium text-white">{{ $product->orders_count }} orders</p>
                                <p class="text-xs text-gray-400">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-2">
                            <p class="text-xs text-gray-400">No products available</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions - Bottom Left -->
        <div class="mt-4">
            <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700">
                <div class="px-3 py-2 border-b border-gray-700">
                    <h3 class="text-sm font-bold text-white">Quick Actions</h3>
                </div>
                <div class="p-3">
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        <a href="{{ route('admin.users.index') }}" 
                           class="flex items-center p-2 bg-gray-700 rounded-md hover:bg-gray-600 transition-colors">
                            <svg class="w-4 h-4 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <span class="text-xs text-white">Manage Users</span>
                        </a>
                        <a href="{{ route('admin.products.index') }}" 
                           class="flex items-center p-2 bg-gray-700 rounded-md hover:bg-gray-600 transition-colors">
                            <svg class="w-4 h-4 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span class="text-xs text-white">Manage Products</span>
                        </a>
                        <a href="{{ route('admin.orders.index') }}" 
                           class="flex items-center p-2 bg-gray-700 rounded-md hover:bg-gray-600 transition-colors">
                            <svg class="w-4 h-4 text-yellow-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="text-xs text-white">View Orders</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="flex items-center p-2 bg-gray-700 rounded-md hover:bg-gray-600 transition-colors">
                            <svg class="w-4 h-4 text-purple-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="text-xs text-white">Manage Categories</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add custom CSS for better responsiveness -->
<style>
    /* Ensure proper text wrapping */
    .break-words {
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    /* Better flex behavior */
    .min-w-0 {
        min-width: 0;
    }
    
    .flex-shrink-0 {
        flex-shrink: 0;
    }
    
    /* Prevent overflow */
    .overflow-hidden {
        overflow: hidden;
    }
    
    .text-ellipsis {
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
    
    /* Force compact layout */
    .force-compact {
        max-width: 100%;
        overflow-x: hidden;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }
    }
    
    @media (min-width: 1025px) {
        .lg\:grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }
</style>
@endsection
