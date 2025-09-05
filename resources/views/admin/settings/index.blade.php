@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black">
    <!-- Header with gradient -->
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 shadow-md border-b border-gray-700">
        <div class="w-full mx-auto px-4 py-3">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-gradient-to-r from-purple-500 to-blue-600 rounded-md shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">Pengaturan Sistem</h1>
                        <p class="text-sm text-gray-400">Konfigurasi pengaturan marketplace</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="w-full mx-auto px-4 py-6">
        @if(session('success'))
        <div class="mb-6 bg-green-500 bg-opacity-20 border border-green-500 text-green-400 px-4 py-3 rounded-md">
            {{ session('success') }}
        </div>
        @endif

        <!-- Settings Form -->
        <div class="bg-gray-800 rounded-lg shadow-sm border border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-700">
                <h3 class="text-lg font-semibold text-white">Pengaturan Umum</h3>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Site Name -->
                    <div>
                        <label for="site_name" class="block text-sm font-medium text-gray-300 mb-2">
                            Nama Situs
                        </label>
                        <input type="text" 
                               id="site_name" 
                               name="site_name" 
                               value="{{ old('site_name', config('app.name', 'Marketplace')) }}"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('site_name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Site Description -->
                    <div>
                        <label for="site_description" class="block text-sm font-medium text-gray-300 mb-2">
                            Deskripsi Situs
                        </label>
                        <textarea id="site_description" 
                                  name="site_description" 
                                  rows="3"
                                  class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('site_description', 'Deskripsi marketplace Anda') }}</textarea>
                        @error('site_description')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Commission Rate -->
                    <div>
                        <label for="commission_rate" class="block text-sm font-medium text-gray-300 mb-2">
                            Tingkat Komisi (%)
                        </label>
                        <input type="number" 
                               id="commission_rate" 
                               name="commission_rate" 
                               min="0" 
                               max="100" 
                               step="0.1"
                               value="{{ old('commission_rate', 10) }}"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="mt-2 text-sm text-gray-400">Persentase penjualan yang menjadi komisi platform</p>
                        @error('commission_rate')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Minimum Withdrawal -->
                    <div>
                        <label for="min_withdrawal" class="block text-sm font-medium text-gray-300 mb-2">
                            Jumlah Minimum Penarikan (Rp)
                        </label>
                        <input type="number" 
                               id="min_withdrawal" 
                               name="min_withdrawal" 
                               min="0" 
                               step="1000"
                               value="{{ old('min_withdrawal', 50000) }}"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('min_withdrawal')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Max Products Per User -->
                    <div>
                        <label for="max_products_per_user" class="block text-sm font-medium text-gray-300 mb-2">
                            Maksimum Produk Per Pengguna
                        </label>
                        <input type="number" 
                               id="max_products_per_user" 
                               name="max_products_per_user" 
                               min="1" 
                               value="{{ old('max_products_per_user', 50) }}"
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('max_products_per_user')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6">
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-md hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-sm font-medium">
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Additional Settings Sections -->
        <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- System Information -->
            <div class="bg-gray-800 rounded-lg shadow-sm border border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-700">
                    <h3 class="text-lg font-semibold text-white">Informasi Sistem</h3>
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-400">Versi Laravel</span>
                        <span class="text-sm text-white">{{ app()->version() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-400">Versi PHP</span>
                        <span class="text-sm text-white">{{ phpversion() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-400">Environment</span>
                        <span class="text-sm text-white">{{ config('app.env') }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-gray-800 rounded-lg shadow-sm border border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-700">
                    <h3 class="text-lg font-semibold text-white">Aksi Cepat</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('admin.reports.index') }}" 
                       class="block text-sm text-blue-400 hover:text-blue-300 transition-colors">
                        Lihat Laporan
                    </a>
                    <a href="{{ route('admin.analytics.index') }}" 
                       class="block text-sm text-blue-400 hover:text-blue-300 transition-colors">
                        Lihat Analitik
                    </a>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="block text-sm text-blue-400 hover:text-blue-300 transition-colors">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
