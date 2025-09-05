<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-100 leading-tight">
            {{ __('🧾 Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-dark shadow-md sm:rounded-lg p-8 space-y-6">

                @forelse ($my_transactions as $transaction)
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6 border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition duration-200 bg-white">
                        
                        {{-- Product Info --}}
                        <div class="flex items-center gap-4 w-full md:w-1/3">
                            <img src="{{ Storage::url($transaction->Product->cover) }}"
                                 alt="{{ $transaction->Product->name }}"
                                 class="h-20 w-20 object-cover rounded-md border" />
                            <div>
                                <h3 class="text-lg font-semibold text-indigo-900">{{ $transaction->Product->name }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $transaction->Product->Category->name }}</p>
                            </div>
                        </div>

                        {{-- Price Info --}}
                        <div class="w-full md:w-1/4 text-center md:text-left">
                            <p class="text-sm text-gray-500">Total Price</p>
                            <p class="text-xl font-bold text-gray-800 mt-1">Rp {{ number_format($transaction->total_price) }}</p>
                        </div>

                        {{-- Status --}}
                        <div class="w-full md:w-1/5 text-center">
                            <p class="text-sm text-gray-500 mb-1">Status</p>
                            @if ($transaction->is_paid)
                                <span class="inline-block px-4 py-1 text-sm rounded-full bg-green-100 text-green-700 font-medium shadow-sm">
                                    ✅ Paid
                                </span>
                            @else
                                <span class="inline-block px-4 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700 font-medium animate-pulse shadow-sm">
                                    ⏳ Pending
                                </span>
                            @endif
                        </div>

                        {{-- Action --}}
                        <div class="w-full md:w-1/5 text-center">
                            <a href="{{ route('admin.product_orders.transactions.details', $transaction) }}"
                               class="inline-block px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition font-semibold shadow">
                                🔍 View Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <h3 class="text-2xl font-semibold text-indigo-800 mb-2">My Transactions</h3>
                        <p class="text-gray-100">Belum ada transaksi yang kamu lakukan. Ayo belanja sekarang! 🛒</p>
                        <a href="{{ route('admin.dashboard') }}"
                           class="mt-5 inline-block px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                            🔙 Kembali ke Dashboard
                        </a>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
