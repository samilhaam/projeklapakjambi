@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header with gradient -->
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-md border-b border-gray-700">
        <div class="w-full max-w-3xl mx-auto px-2 sm:px-3 lg:px-4 py-1.5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1.5">
                <div class="flex items-center space-x-1.5">
                    <div class="p-0.5 bg-gradient-to-r from-purple-500 to-blue-600 rounded-md shadow-sm">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-sm sm:text-base font-bold text-white">Marketplace Performance Dashboard</h1>
                        <p class="text-xs text-gray-400">Comprehensive analytics and insights</p>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row gap-1">
                    <button onclick="window.print()" class="px-1.5 py-0.5 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-md hover:from-green-600 hover:to-green-700 transition-all duration-300 shadow-sm font-medium flex items-center justify-center space-x-1 text-xs">
                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        <span>Print Report</span>
                    </button>
                    <a href="{{ route('admin.analytics.index') }}" class="px-1.5 py-0.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-md hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-sm font-medium flex items-center justify-center space-x-1 text-xs">
                        <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span>Analytics</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="w-full max-w-3xl mx-auto px-2 sm:px-3 lg:px-4 py-2">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-1.5 mb-2">
            <!-- Total Revenue -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-md p-1.5 shadow-sm transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-green-100 text-xs font-medium">Total Revenue</p>
                        <p class="text-base font-bold text-white">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                        <p class="text-green-200 text-xs">All time revenue</p>
                    </div>
                    <div class="p-1 bg-white bg-opacity-20 rounded-md ml-1.5 flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-md p-1.5 shadow-sm transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-blue-100 text-xs font-medium">Total Orders</p>
                        <p class="text-base font-bold text-white">{{ $totalOrders ?? 0 }}</p>
                        <p class="text-blue-200 text-xs">All time orders</p>
                    </div>
                    <div class="p-1 bg-white bg-opacity-20 rounded-md ml-1.5 flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Avg Order Value -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-md p-1.5 shadow-sm transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-yellow-100 text-xs font-medium">Avg Order Value</p>
                        <p class="text-base font-bold text-white">
                            Rp {{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 0, ',', '.') : '0' }}
                        </p>
                        <p class="text-yellow-200 text-xs">Per order average</p>
                    </div>
                    <div class="p-1 bg-white bg-opacity-20 rounded-md ml-1.5 flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Performance Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mb-2">
            <!-- Top Selling Products -->
            <div class="bg-gray-800 rounded-md shadow-sm border border-gray-700 overflow-hidden">
                <div class="px-1.5 py-1 border-b border-gray-700">
                    <div class="flex items-center space-x-1.5">
                        <div class="p-0.5 bg-gradient-to-r from-orange-500 to-orange-600 rounded-md">
                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-white">Top Selling Products</h3>
                            <p class="text-xs text-gray-400">Best performing products</p>
                        </div>
                    </div>
                </div>
                <div class="p-1.5">
                    <div class="space-y-1">
                        @forelse($topProducts ?? [] as $product)
                        <div class="flex items-center justify-between p-1 bg-gray-700 rounded-md hover:bg-gray-600 transition-all duration-300">
                            <div class="flex items-center space-x-1.5 flex-1 min-w-0">
                                <div class="flex-shrink-0 h-5 w-5">
                                    @if($product->cover)
                                        <img class="h-5 w-5 rounded-md object-cover" 
                                             src="{{ \App\Helpers\ImageHelper::getProductCoverUrl($product) }}" 
                                             alt="{{ $product->name }}">
                                    @else
                                        <div class="h-5 w-5 rounded-md bg-gray-600 flex items-center justify-center">
                                            <svg class="h-2.5 w-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-medium text-white break-words">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-400 break-words">{{ $product->creator->name ?? 'Unknown' }}</div>
                                </div>
                            </div>
                            <div class="text-right ml-1.5 flex-shrink-0">
                                <div class="text-xs font-medium text-white">{{ $product->orders_count ?? 0 }} orders</div>
                                <div class="text-xs text-green-400 font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-gray-400 py-2">
                            <svg class="w-5 h-5 mx-auto mb-0.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <p class="text-xs font-medium">No products found</p>
                            <p class="text-xs">No products have been sold yet</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Top Performing UMKM -->
            <div class="bg-gray-800 rounded-md shadow-sm border border-gray-700 overflow-hidden">
                <div class="px-1.5 py-1 border-b border-gray-700">
                    <div class="flex items-center space-x-1.5">
                        <div class="p-0.5 bg-gradient-to-r from-purple-500 to-purple-600 rounded-md">
                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-white">Top Performing UMKM</h3>
                            <p class="text-xs text-gray-400">Best performing sellers</p>
                        </div>
                    </div>
                </div>
                <div class="p-1.5">
                    <div class="space-y-1">
                        @forelse($topSellers ?? [] as $seller)
                        <div class="flex items-center justify-between p-1 bg-gray-700 rounded-md hover:bg-gray-600 transition-all duration-300">
                            <div class="flex items-center space-x-1.5 flex-1 min-w-0">
                                <div class="flex-shrink-0 h-5 w-5 bg-gradient-to-br from-purple-500 to-purple-600 rounded-md flex items-center justify-center">
                                    <span class="text-white font-bold text-xs">{{ substr($seller->name, 0, 1) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-medium text-white break-words">{{ $seller->name }}</div>
                                    <div class="text-xs text-gray-400 break-words">{{ $seller->email }}</div>
                                </div>
                            </div>
                            <div class="text-right ml-1.5 flex-shrink-0">
                                <div class="text-xs font-medium text-white">{{ $seller->products_count ?? 0 }} products</div>
                                <div class="text-xs text-blue-400 font-medium">{{ $seller->orders_count ?? 0 }} orders</div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-gray-400 py-2">
                            <svg class="w-5 h-5 mx-auto mb-0.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-xs font-medium">No sellers found</p>
                            <p class="text-xs">No sellers have registered yet</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-gray-800 rounded-md shadow-sm border border-gray-700 overflow-hidden">
            <div class="px-1.5 py-1 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-1.5">
                        <div class="p-0.5 bg-gradient-to-r from-green-500 to-green-600 rounded-md">
                            <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-white">Recent Transactions</h3>
                            <p class="text-xs text-gray-400">Latest marketplace activity</p>
                        </div>
                    </div>
                    <div class="text-xs text-gray-400">{{ count($recentOrders ?? []) }} transactions</div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-1.5 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Order ID</th>
                            <th class="px-1.5 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Customer</th>
                            <th class="px-1.5 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Product</th>
                            <th class="px-1.5 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Amount</th>
                            <th class="px-1.5 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-1.5 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse($recentOrders ?? [] as $order)
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="px-1.5 py-1 whitespace-nowrap text-xs text-white font-medium">
                                #{{ $order->id }}
                            </td>
                            <td class="px-1.5 py-1 whitespace-nowrap">
                                <div class="text-xs text-white font-medium break-words">{{ $order->pembeli->name ?? 'Unknown' }}</div>
                                <div class="text-xs text-gray-400 break-words">{{ $order->pembeli->email ?? '' }}</div>
                            </td>
                            <td class="px-1.5 py-1 whitespace-nowrap">
                                <div class="text-xs text-white font-medium break-words">{{ $order->product->name ?? 'Unknown' }}</div>
                                <div class="text-xs text-gray-400 break-words">{{ $order->product->Creator->name ?? 'Unknown' }}</div>
                            </td>
                            <td class="px-1.5 py-1 whitespace-nowrap text-xs text-green-400 font-bold">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-1.5 py-1 whitespace-nowrap">
                                @if($order->is_paid)
                                    <span class="inline-flex px-0.5 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                @else
                                    <span class="inline-flex px-0.5 py-0.5 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending
                                    </span>
                                @endif
                            </td>
                            <td class="px-1.5 py-1 whitespace-nowrap text-xs text-gray-400">
                                {{ $order->created_at->format('M d, Y H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-1.5 py-3 text-center">
                                <div class="text-gray-400">
                                    <svg class="w-5 h-5 mx-auto mb-0.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-xs font-medium">No transactions found</p>
                                    <p class="text-xs">No transactions have been made yet</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
    
    /* Better table responsiveness */
    @media (max-width: 1024px) {
        .overflow-x-auto {
            -webkit-overflow-scrolling: touch;
        }
    }
    
    /* Ensure proper flex behavior */
    .min-w-0 {
        min-width: 0;
    }
    
    .flex-shrink-0 {
        flex-shrink: 0;
    }
    
    /* Custom scrollbar for table */
    .overflow-x-auto::-webkit-scrollbar {
        height: 2px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #374151;
        border-radius: 1px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #6b7280;
        border-radius: 1px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    
    /* Optimize for 100% zoom */
    @media screen and (min-width: 1200px) {
        .max-w-3xl {
            max-width: 48rem;
        }
    }
    
    @media screen and (max-width: 1199px) {
        .max-w-3xl {
            max-width: 100%;
        }
    }
    
    /* Compact layout for 100% zoom */
    @media screen and (min-width: 1024px) {
        .container {
            max-width: 800px;
        }
    }
    
    /* Ensure navbar doesn't get cut off */
    body {
        overflow-x: hidden;
    }
    
    /* Reduce vertical spacing for 100% zoom */
    .min-h-screen {
        min-height: calc(100vh - 60px);
    }
</style>
@endsection 
