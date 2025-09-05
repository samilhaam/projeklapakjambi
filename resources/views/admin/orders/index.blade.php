@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header with gradient -->
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-2xl border-b border-gray-700">
        <div class="max-w-screen-xl mx-auto px-2 sm:px-3 lg:px-4 py-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="p-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-md shadow-lg">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-base font-bold text-white">Order Management</h1>
                        <p class="text-gray-400 text-[11px]">Manage all marketplace orders</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="text-right">
                        <p class="text-white font-medium text-[11px]">{{ Auth::user()->name }}</p>
                        <p class="text-gray-400 text-[11px]">{{ now()->format('l, F j, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-screen-xl mx-auto px-2 sm:px-3 lg:px-4 py-3">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-3">
            <!-- Total Orders -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-2.5 shadow-lg transform hover:scale-[1.02] transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-blue-100 text-xs font-medium">Total Orders</p>
                        <p class="text-xl font-bold text-white">{{ $orders->total() }}</p>
                        <p class="text-blue-200 text-xs mt-1">All orders</p>
                    </div>
                    <div class="p-2 bg-white bg-opacity-20 rounded-md ml-2 flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg p-2.5 shadow-lg transform hover:scale-[1.02] transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-yellow-100 text-xs font-medium">Pending</p>
                        <p class="text-xl font-bold text-white">{{ $orders->where('status', 'pending')->count() }}</p>
                        <p class="text-yellow-200 text-xs mt-1">Awaiting confirmation</p>
                    </div>
                    <div class="p-2 bg-white bg-opacity-20 rounded-md ml-2 flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed Orders -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg p-2.5 shadow-lg transform hover:scale-[1.02] transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-green-100 text-xs font-medium">Completed</p>
                        <p class="text-xl font-bold text-white">{{ $orders->where('status', 'completed')->count() }}</p>
                        <p class="text-green-200 text-xs mt-1">Successfully delivered</p>
                    </div>
                    <div class="p-2 bg-white bg-opacity-20 rounded-md ml-2 flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg p-2.5 shadow-lg transform hover:scale-[1.02] transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-purple-100 text-xs font-medium">Total Revenue</p>
                        <p class="text-xl font-bold text-white">Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}</p>
                        <p class="text-purple-200 text-xs mt-1">From all orders</p>
                    </div>
                    <div class="p-2 bg-white bg-opacity-20 rounded-md ml-2 flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700 overflow-hidden">
            <div class="px-3 py-2 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-white">All Orders</h3>
                    <div class="text-xs text-gray-400">{{ $orders->total() }} orders found</div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Order</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Product</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Buyer</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="px-3 py-2">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center mr-2">
                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-white">#{{ $order->id }}</div>
                                        <div class="text-xs text-gray-400">{{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2">
                                <div class="flex items-center">
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-medium text-white break-words">{{ $order->product->name ?? 'Product Deleted' }}</div>
                                        <div class="text-xs text-gray-400">{{ $order->product->creator->name ?? 'Unknown' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center mr-2">
                                        <span class="text-white font-bold text-xs">{{ strtoupper(substr($order->pembeli->name ?? 'U', 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-white">{{ $order->pembeli->name ?? 'User Deleted' }}</div>
                                        <div class="text-xs text-gray-400">{{ $order->pembeli->email ?? 'No email' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-2 text-sm text-white font-medium">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-3 py-2">
                                @switch($order->status)
                                    @case('pending')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            Pending
                                        </span>
                                        @break
                                    @case('processing')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            Processing
                                        </span>
                                        @break
                                    @case('completed')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Completed
                                        </span>
                                        @break
                                    @case('cancelled')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                            Cancelled
                                        </span>
                                        @break
                                    @default
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                @endswitch
                            </td>
                            <td class="px-3 py-2 text-sm text-gray-300">
                                {{ $order->created_at->diffForHumans() }}
                            </td>
                            <td class="px-3 py-2 text-sm font-medium">
                                <div class="flex space-x-1">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                                       class="text-blue-400 hover:text-blue-300 transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.orders.edit', $order->id) }}" 
                                       class="text-yellow-400 hover:text-yellow-300 transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-3 py-4 text-center">
                                <div class="text-gray-400">
                                    <svg class="w-6 h-6 mx-auto mb-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <p class="text-xs font-medium">No orders found</p>
                                    <p class="text-xs">No orders have been placed yet</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
            <div class="px-3 py-2 border-t border-gray-700">
                {{ $orders->links() }}
            </div>
            @endif
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
    
    /* Custom scrollbar for table */
    .overflow-x-auto::-webkit-scrollbar {
        height: 3px;
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
</style>
@endsection 
