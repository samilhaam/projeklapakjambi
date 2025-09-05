<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-100 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">  
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 p-6 shadow-md rounded-lg space-y-6">

                @forelse ($my_orders as $order)
                    <div class="border rounded-lg p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 shadow-sm hover:shadow-md transition duration-300">
                        <div class="flex items-center gap-4">
                            <img src="{{ Storage::url($order->Product->cover) }}" class="h-24 w-24 object-cover rounded-md border" alt="{{ $order->Product->name }}">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-100">{{ $order->Product->name }}</h3>
                                <p class="text-gray-600 mt-1">Rp {{ number_format($order->total_price) }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-6 gap-3">
                            @if ($order->is_paid)
                                <span class="inline-block px-4 py-2 rounded-full bg-green-500 text-white font-semibold text-sm text-center">
                                    PAID
                                </span>
                            @else
                                <span class="inline-block px-4 py-2 rounded-full bg-orange-500 text-white font-semibold text-sm text-center">
                                    PENDING
                                </span>
                            @endif

                            <a href="{{ route('admin.product_orders.show', $order->id) }}"
                                class="inline-block px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-full transition">
                                Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <h3 class="text-2xl font-semibold text-gray-1x00 mb-2">My Orders</h3>
                        <p class="text-gray-100">Belum ada yang membeli produk kamu 😌</p>
                        <a href="{{ route('admin.dashboard') }}"
                            class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                            Kembali ke Dashboard
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
