<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm p-6 sm:rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-white font-bold text-3xl">My Purchases</h1>
                    <a href="{{ route('pembeli.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        ← Home
                    </a>
                </div>

                @if($myPurchases->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($myPurchases as $purchase)
                            <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-white font-semibold text-lg">{{ $purchase->product->name }}</h3>
                                    @if($purchase->is_paid)
                                        <span class="bg-green-500 text-white px-2 py-1 rounded text-sm">Paid</span>
                                    @else
                                        <span class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">Pending</span>
                                    @endif
                                </div>
                                
                                <img src="{{ \App\Helpers\ImageHelper::getProductCoverUrl($purchase->product) }}" alt="{{ $purchase->product->name }}" class="w-full h-32 object-cover rounded mb-4">
                                
                                <div class="mb-4">
                                    <p class="text-gray-300 text-sm mb-2">
                                        <strong>Pelaku UMKM:</strong> {{ $purchase->creator ? $purchase->creator->name : 'Unknown' }}
                                    </p>
                                    <p class="text-gray-300 text-sm mb-2">
                                        <strong>Price:</strong> <span class="text-yellow-500 font-bold">Rp {{ number_format($purchase->total_price) }}</span>
                                    </p>
                                    <p class="text-gray-300 text-sm">
                                        <strong>Date:</strong> {{ $purchase->created_at->format('d M Y H:i') }}
                                    </p>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    @if($purchase->is_paid)
                                        <a href="{{ route('pembeli.download', $purchase) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm">
                                            Download Product
                                        </a>
                                    @else
                                        <span class="text-gray-500 text-sm">Waiting for payment confirmation</span>
                                    @endif
                                    
                                    <a href="{{ route('front.details', $purchase->product) }}" class="text-blue-400 hover:text-blue-300 text-sm">
                                        View Product
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="bg-gray-800 border-2 border-dashed border-gray-600 rounded-lg p-8">
                            <div class="text-gray-500 text-6xl mb-4">🛒</div>
                            <h3 class="text-gray-400 text-xl font-semibold mb-2">Belum ada pembelian.</h3>
                            <p class="text-gray-500">Pembelian Anda akan muncul di sini setelah Anda membeli produk.</p>
                            <a href="{{ route('front.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded">
                                Browse Products
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout> 
