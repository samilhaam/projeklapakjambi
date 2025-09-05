@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header with gradient -->
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-sm border-b border-gray-700">
        <div class="w-full max-w-2xl mx-auto px-1.5 sm:px-2 lg:px-3 py-1">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-1">
                    <div class="p-0.5 bg-gradient-to-r from-green-500 to-blue-600 rounded-sm shadow-sm">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xs sm:text-sm font-bold text-white">Category Management</h1>
                        <p class="text-gray-400 text-xs">Manage product categories</p>
                    </div>
                </div>
                <div class="flex items-center space-x-1">
                    <a href="{{ route('admin.categories.create') }}" 
                       class="px-1 py-0.5 bg-green-600 text-white rounded-sm hover:bg-green-700 transition-colors text-xs flex items-center space-x-0.5">
                        <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span>Add Category</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="w-full max-w-2xl mx-auto px-1.5 sm:px-2 lg:px-3 py-1.5">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-1 mb-1.5">
            <!-- Total Categories -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-sm p-1 shadow-sm transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-green-100 text-xs font-medium">Total Categories</p>
                        <p class="text-sm font-bold text-white">{{ $stats['total'] }}</p>
                        <p class="text-green-200 text-xs">All categories</p>
                    </div>
                    <div class="p-0.5 bg-white bg-opacity-20 rounded-sm ml-1 flex-shrink-0">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Categories -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-sm p-1 shadow-sm transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-blue-100 text-xs font-medium">Active Categories</p>
                        <p class="text-sm font-bold text-white">{{ $stats['active'] }}</p>
                        <p class="text-blue-200 text-xs">With products</p>
                    </div>
                    <div class="p-0.5 bg-white bg-opacity-20 rounded-sm ml-1 flex-shrink-0">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Empty Categories -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-sm p-1 shadow-sm transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-yellow-100 text-xs font-medium">Empty Categories</p>
                        <p class="text-sm font-bold text-white">{{ $stats['empty'] }}</p>
                        <p class="text-yellow-200 text-xs">No products</p>
                    </div>
                    <div class="p-0.5 bg-white bg-opacity-20 rounded-sm ml-1 flex-shrink-0">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Products -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-sm p-1 shadow-sm transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-purple-100 text-xs font-medium">Total Products</p>
                        <p class="text-sm font-bold text-white">{{ $stats['total_products'] }}</p>
                        <p class="text-purple-200 text-xs">Across all categories</p>
                    </div>
                    <div class="p-0.5 bg-white bg-opacity-20 rounded-sm ml-1 flex-shrink-0">
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="bg-gray-800 rounded-sm shadow-sm border border-gray-700 overflow-hidden">
            <div class="px-1 py-0.5 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-bold text-white">All Categories</h3>
                    <div class="text-xs text-gray-400">{{ $categories->total() }} categories found</div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-1 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Category</th>
                            <th class="px-1 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Description</th>
                            <th class="px-1 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Products</th>
                            <th class="px-1 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Created</th>
                            <th class="px-1 py-0.5 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse($categories as $category)
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="px-1 py-0.5">
                                <div class="flex items-center">
                                    @if($category->icon)
                                        <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="w-4 h-4 rounded mr-1">
                                    @else
                                        <div class="w-4 h-4 bg-green-500 rounded mr-1 flex items-center justify-center">
                                            <svg class="w-2 h-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="min-w-0 flex-1">
                                        <div class="text-xs font-medium text-white break-words">{{ $category->name }}</div>
                                        <div class="text-xs text-gray-400">ID: {{ $category->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-1 py-0.5">
                                <div class="text-xs text-gray-300 break-words">
                                    {{ $category->description ?? 'No description' }}
                                </div>
                            </td>
                            <td class="px-1 py-0.5">
                                <div class="flex items-center">
                                    <span class="inline-flex px-0.5 py-0.5 text-xs font-semibold rounded-full 
                                        {{ $category->products_count > 0 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $category->products_count }} products
                                    </span>
                                </div>
                            </td>
                            <td class="px-1 py-0.5 text-xs text-gray-300">
                                {{ $category->created_at->diffForHumans() }}
                            </td>
                            <td class="px-1 py-0.5 text-xs font-medium">
                                <div class="flex space-x-0.5">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                       class="text-blue-400 hover:text-blue-300 transition-colors">
                                        <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    @if($category->products_count == 0)
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-400 hover:text-red-300 transition-colors"
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                            <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-1 py-1.5 text-center">
                                <div class="text-gray-400">
                                    <svg class="w-4 h-4 mx-auto mb-0.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <p class="text-xs font-medium">No categories found</p>
                                    <p class="text-xs">Create your first category</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($categories->hasPages())
            <div class="px-1 py-0.5 border-t border-gray-700">
                {{ $categories->links() }}
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
        height: 1px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #374151;
        border-radius: 0px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #6b7280;
        border-radius: 0px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    
    /* Optimize for 100% zoom */
    @media screen and (min-width: 1200px) {
        .max-w-2xl {
            max-width: 42rem;
        }
    }
    
    @media screen and (max-width: 1199px) {
        .max-w-2xl {
            max-width: 100%;
        }
    }
    
    /* Compact layout for 100% zoom */
    @media screen and (min-width: 1024px) {
        .container {
            max-width: 700px;
        }
    }
    
    /* Ensure navbar doesn't get cut off */
    body {
        overflow-x: hidden;
    }
    
    /* Reduce vertical spacing for 100% zoom */
    .min-h-screen {
        min-height: calc(100vh - 50px);
    }
    
    /* Extreme compact spacing */
    .space-x-0\.5 > :not([hidden]) ~ :not([hidden]) {
        margin-left: 0.125rem;
    }
    
    .space-x-1 > :not([hidden]) ~ :not([hidden]) {
        margin-left: 0.25rem;
    }
    
    /* Reduce all padding and margins */
    .p-0\.5 {
        padding: 0.125rem;
    }
    
    .px-1 {
        padding-left: 0.25rem;
        padding-right: 0.25rem;
    }
    
    .py-0\.5 {
        padding-top: 0.125rem;
        padding-bottom: 0.125rem;
    }
    
    .py-1 {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
    }
    
    .mb-1 {
        margin-bottom: 0.25rem;
    }
    
    .mb-1\.5 {
        margin-bottom: 0.375rem;
    }
    
    .gap-1 {
        gap: 0.25rem;
    }
    
    .rounded-sm {
        border-radius: 0.125rem;
    }
</style>
@endsection 
