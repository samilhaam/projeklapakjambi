@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header with gradient -->
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-2xl border-b border-gray-700">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-5 lg:px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">Product Management</h1>
                        <p class="text-gray-400">Manage all marketplace products</p>
                    </div>
                </div>
                <a href="{{ route('admin.products.create') }}" 
                   class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg font-medium">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    + Add Product
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-screen-xl mx-auto px-4 sm:px-5 lg:px-6 py-6 compact-cards">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Products -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 shadow-2xl transform hover:scale-[1.02] transition-all duration-300 compact-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-blue-100 text-sm font-medium">Total Products</p>
                        <p class="text-2xl font-bold text-white">{{ $products->total() }}</p>
                        <p class="text-blue-200 text-xs mt-1">All products in system</p>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl ml-3 flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Products -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-5 shadow-2xl transform hover:scale-[1.02] transition-all duration-300 compact-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-green-100 text-sm font-medium">Active Products</p>
                        <p class="text-2xl font-bold text-white">{{ $products->where('is_active', true)->count() }}</p>
                        <p class="text-green-200 text-xs mt-1">Currently active</p>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl ml-3 flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Value -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-5 shadow-2xl transform hover:scale-[1.02] transition-all duration-300 compact-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-yellow-100 text-sm font-medium">Total Value</p>
                        <p class="text-2xl font-bold text-white">Rp {{ number_format($products->sum('price'), 0, ',', '.') }}</p>
                        <p class="text-yellow-200 text-xs mt-1">Combined value</p>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl ml-3 flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Creators -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-5 shadow-2xl transform hover:scale-[1.02] transition-all duration-300 compact-card">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-purple-100 text-sm font-medium">Creators</p>
                        <p class="text-2xl font-bold text-white">{{ $products->unique('creator_id')->count() }}</p>
                        <p class="text-purple-200 text-xs mt-1">Active creators</p>
                    </div>
                    <div class="p-3 bg-white bg-opacity-20 rounded-xl ml-3 flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="bg-gray-800 rounded-2xl shadow-xl border border-gray-700 overflow-hidden">
            <div class="px-5 py-3 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">All Products</h3>
                    <div class="text-sm text-gray-400">{{ $products->total() }} products found</div>
                </div>
            </div>
            
            <div class="overflow-x-auto w-full">
                <table class="min-w-full divide-y divide-gray-700 table-auto">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Creator</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse($products as $product)
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        @if($product->cover)
                                            <img class="h-12 w-12 rounded-lg object-cover" 
                                                 src="{{ \App\Helpers\ImageHelper::getProductCoverUrl($product) }}" 
                                                 alt="{{ $product->name }}">
                                        @else
                                            <div class="h-12 w-12 rounded-lg bg-gray-600 flex items-center justify-center">
                                                <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex-1 min-w-0">
                                        <div class="text-sm font-medium text-white break-words">{{ $product->name }}</div>
                                        <div class="text-sm text-gray-400 break-words">{{ Str::limit($product->description, 60) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-white break-words">{{ $product->creator->name ?? 'Unknown' }}</div>
                                <div class="text-sm text-gray-400 break-words">{{ $product->creator->email ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $product->category->name ?? 'No Category' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-white font-medium">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($product->is_active)
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium">
                                <div class="flex space-x-3">
                                    <a href="{{ route('admin.products.show', $product) }}" 
                                       class="text-blue-400 hover:text-blue-300 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="text-yellow-400 hover:text-yellow-300 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" 
                                          class="inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No products found</p>
                                    <p class="text-sm">Start by adding your first product</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-700">
                {{ $products->links() }}
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
        height: 8px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #374151;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #6b7280;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
</style>
@endsection
