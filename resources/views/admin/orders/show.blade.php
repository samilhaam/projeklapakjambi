@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header -->
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-2xl border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-2 sm:px-3 lg:px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.orders.index') }}" class="text-gray-400 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div class="p-1.5 bg-gradient-to-r from-blue-500 to-purple-600 rounded-md shadow-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-white">Order Details</h1>
                        <p class="text-gray-400 text-xs">Order #{{ $order->id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-2 sm:px-3 lg:px-4 py-3">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <!-- Order Information -->
            <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700">
                <div class="px-3 py-2 border-b border-gray-700">
                    <h3 class="text-sm font-bold text-white">Order Information</h3>
                </div>
                <div class="p-3 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Order ID:</span>
                        <span class="text-xs font-medium text-white">#{{ $order->id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Status:</span>
                        <span class="text-xs font-medium text-white">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Total Price:</span>
                        <span class="text-xs font-medium text-white">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Created:</span>
                        <span class="text-xs font-medium text-white">{{ $order->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Updated:</span>
                        <span class="text-xs font-medium text-white">{{ $order->updated_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </div>

            <!-- Product Information -->
            <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700">
                <div class="px-3 py-2 border-b border-gray-700">
                    <h3 class="text-sm font-bold text-white">Product Information</h3>
                </div>
                <div class="p-3 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Product:</span>
                        <span class="text-xs font-medium text-white">{{ $order->product->name ?? 'Product Deleted' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Price:</span>
                        <span class="text-xs font-medium text-white">Rp {{ number_format($order->product->price ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Seller:</span>
                        <span class="text-xs font-medium text-white">{{ $order->product->creator->name ?? 'Unknown' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Category:</span>
                        <span class="text-xs font-medium text-white">{{ $order->product->category->name ?? 'No Category' }}</span>
                    </div>
                </div>
            </div>

            <!-- Buyer Information -->
            <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700">
                <div class="px-3 py-2 border-b border-gray-700">
                    <h3 class="text-sm font-bold text-white">Buyer Information</h3>
                </div>
                <div class="p-3 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Name:</span>
                        <span class="text-xs font-medium text-white">{{ $order->pembeli->name ?? 'User Deleted' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Email:</span>
                        <span class="text-xs font-medium text-white">{{ $order->pembeli->email ?? 'No email' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Role:</span>
                        <span class="text-xs font-medium text-white">{{ ucfirst($order->pembeli->role ?? 'Unknown') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-xs text-gray-400">Joined:</span>
                        <span class="text-xs font-medium text-white">{{ $order->pembeli->created_at->format('M d, Y') ?? 'Unknown' }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700">
                <div class="px-3 py-2 border-b border-gray-700">
                    <h3 class="text-sm font-bold text-white">Actions</h3>
                </div>
                <div class="p-3 space-y-2">
                    <a href="{{ route('admin.orders.edit', $order->id) }}" 
                       class="w-full flex items-center justify-center px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        <span class="text-xs">Edit Order</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" 
                       class="w-full flex items-center justify-center px-3 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <span class="text-xs">Back to Orders</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 
