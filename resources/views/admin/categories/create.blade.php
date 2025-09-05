@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header -->
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-2xl border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-2 sm:px-3 lg:px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.categories.index') }}" class="text-gray-400 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <div class="p-1.5 bg-gradient-to-r from-green-500 to-blue-600 rounded-md shadow-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-white">Create Category</h1>
                        <p class="text-gray-400 text-xs">Add new product category</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-2xl mx-auto px-2 sm:px-3 lg:px-4 py-3">
        <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700">
            <div class="px-3 py-2 border-b border-gray-700">
                <h3 class="text-sm font-bold text-white">Category Information</h3>
            </div>
            <div class="p-3">
                <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-3">
                        <div>
                            <label for="name" class="block text-xs font-medium text-gray-300 mb-1">Category Name</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-sm text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                            @error('name')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="description" class="block text-xs font-medium text-gray-300 mb-1">Description</label>
                            <textarea id="description" name="description" rows="3"
                                      class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-sm text-white focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="icon" class="block text-xs font-medium text-gray-300 mb-1">Icon (Optional)</label>
                            <input type="file" id="icon" name="icon" accept="image/*"
                                   class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-sm text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                            @error('icon')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex space-x-2 pt-3">
                            <button type="submit" class="flex-1 px-3 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors text-sm">
                                Create Category
                            </button>
                            <a href="{{ route('admin.categories.index') }}" class="flex-1 px-3 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors text-sm text-center">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 
