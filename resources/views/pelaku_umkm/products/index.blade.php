<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-800 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm p-6 sm:rounded-lg">
                <!-- Back Button -->
                <div class="flex justify-start mb-6">
                    <a href="{{ route('pelaku_umkm.dashboard') }}" class="flex items-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <h1 class="text-white font-bold text-2xl sm:text-3xl">My Products</h1>
                    <a href="{{ route('pelaku_umkm.products.create') }}" class="bg-yellow-500 hover:bg-yellow-600 text-purple-900 font-bold py-2 px-4 rounded text-sm">
                        + Add Product
                    </a>
                </div>

                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                        @foreach($products as $product)
                            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-white font-semibold text-base sm:text-lg truncate">{{ $product->name }}</h3>
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-xs sm:text-sm flex-shrink-0">Active</span>
                                </div>
                                
                                <img src="{{ \App\Helpers\ImageHelper::getProductCoverUrl($product) }}" alt="{{ $product->name }}" class="w-full h-24 sm:h-32 object-cover rounded mb-3">
                                
                                <p class="text-gray-300 text-xs sm:text-sm mb-3 line-clamp-2">{{ Str::limit($product->about, 80) }}</p>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-yellow-500 font-bold text-sm sm:text-base">Rp {{ number_format($product->price) }}</span>
                                    <div class="flex gap-1 sm:gap-2">
                                        <a href="{{ route('pelaku_umkm.products.edit', $product) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded text-xs sm:text-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('pelaku_umkm.products.destroy', $product) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs sm:text-sm" onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="bg-gray-800 border-2 border-dashed border-orange-500 rounded-lg p-6 max-w-md mx-auto">
                            <div class="text-red-500 text-4xl sm:text-6xl mb-4">⛔</div>
                            <h3 class="text-yellow-500 text-lg sm:text-xl font-semibold mb-2">Belum ada produk.</h3>
                            <p class="text-white text-sm sm:text-base">Klik tombol + Add Product di atas untuk menambahkan produk pertama Anda.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout> 
