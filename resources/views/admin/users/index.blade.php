@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header with gradient -->
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-2xl border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-1 sm:px-2 lg:px-3 py-2">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-1.5">
                    <div class="p-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-md shadow-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-white">User Management</h1>
                        <p class="text-gray-400 text-xs">Manage all marketplace users</p>
                    </div>
                </div>
                <div class="flex items-center space-x-1.5">
                    <div class="text-right">
                        <p class="text-white font-medium text-xs">{{ Auth::user()->name }}</p>
                        <p class="text-gray-400 text-xs">{{ now()->format('l, F j, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-1 sm:px-2 lg:px-3 py-3">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2 mb-3">
            <!-- Total Users -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-md p-2 shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-blue-100 text-xs font-medium">Total Users</p>
                        <p class="text-lg font-bold text-white">{{ $users->total() }}</p>
                        <p class="text-blue-200 text-xs mt-1">All registered users</p>
                    </div>
                    <div class="p-1.5 bg-white bg-opacity-20 rounded ml-1.5 flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Users -->
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-md p-2 shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-green-100 text-xs font-medium">Active Users</p>
                        <p class="text-lg font-bold text-white">{{ $users->where('is_active', true)->count() }}</p>
                        <p class="text-green-200 text-xs mt-1">Currently active</p>
                    </div>
                    <div class="p-1.5 bg-white bg-opacity-20 rounded ml-1.5 flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pelaku UMKM -->
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-md p-2 shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-yellow-100 text-xs font-medium">Pelaku UMKM</p>
                        <p class="text-lg font-bold text-white">{{ $users->where('role', 'pelaku_umkm')->count() }}</p>
                        <p class="text-yellow-200 text-xs mt-1">Business owners</p>
                    </div>
                    <div class="p-1.5 bg-white bg-opacity-20 rounded ml-1.5 flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pembeli -->
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-md p-2 shadow-lg transform hover:scale-105 transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div class="flex-1 min-w-0">
                        <p class="text-purple-100 text-xs font-medium">Pembeli</p>
                        <p class="text-lg font-bold text-white">{{ $users->where('role', 'pembeli')->count() }}</p>
                        <p class="text-purple-200 text-xs mt-1">Customers</p>
                    </div>
                    <div class="p-1.5 bg-white bg-opacity-20 rounded ml-1.5 flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-gray-800 rounded-md shadow-lg border border-gray-700 overflow-hidden">
            <div class="px-2 py-1.5 border-b border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-white">All Users</h3>
                    <div class="text-xs text-gray-400">{{ $users->total() }} users found</div>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">User</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Role</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Products</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Orders</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-2 py-1 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @forelse($users as $user)
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="px-2 py-1.5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-6 w-6">
                                        <div class="h-6 w-6 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center shadow-lg">
                                            <span class="text-white font-bold text-xs">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-1.5 flex-1 min-w-0">
                                        <div class="text-sm font-medium text-white break-words">{{ $user->name }}</div>
                                        <div class="text-xs text-gray-400 break-words">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 py-1.5">
                                @switch($user->role)
                                    @case('admin')
                                        <span class="inline-flex px-1 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            <svg class="w-2 h-2 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Admin
                                        </span>
                                        @break
                                    @case('pelaku_umkm')
                                        <span class="inline-flex px-1 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            <svg class="w-2 h-2 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Pelaku UMKM
                                        </span>
                                        @break
                                    @case('pembeli')
                                        <span class="inline-flex px-1 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            <svg class="w-2 h-2 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Pembeli
                                        </span>
                                        @break
                                    @default
                                        <span class="inline-flex px-1 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                @endswitch
                            </td>
                            <td class="px-2 py-1.5 text-sm text-white font-medium">
                                {{ $user->products_count ?? 0 }}
                            </td>
                            <td class="px-2 py-1.5 text-sm text-white font-medium">
                                {{ $user->orders_count ?? 0 }}
                            </td>
                            <td class="px-2 py-1.5">
                                @if($user->is_active ?? true)
                                    <span class="inline-flex px-1 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        <svg class="w-2 h-2 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex px-1 py-0.5 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        <svg class="w-2 h-2 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-2 py-1.5 text-sm font-medium">
                                <div class="flex space-x-1">
                                    <a href="{{ route('admin.users.show', $user) }}" 
                                       class="text-blue-400 hover:text-blue-300 transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.users.edit', $user) }}" 
                                       class="text-yellow-400 hover:text-yellow-300 transition-colors">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    @if($user->id !== Auth::id())
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" 
                                          class="inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <td colspan="6" class="px-2 py-4 text-center">
                                <div class="text-gray-400">
                                    <svg class="w-6 h-6 mx-auto mb-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                    <p class="text-xs font-medium">No users found</p>
                                    <p class="text-xs">No users have been registered yet</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
            <div class="px-2 py-1.5 border-t border-gray-700">
                {{ $users->links() }}
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
</style>
@endsection 
