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
                    <h1 class="text-white font-bold text-3xl">My Transactions</h1>
                    <a href="{{ route('pelaku_umkm.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        ← Back to Dashboard
                    </a>
                </div>

                @if($my_transactions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-gray-800 border border-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Product
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Pelaku UMKM
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-700 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800">
                                @foreach($my_transactions as $transaction)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ \App\Helpers\ImageHelper::getProductCoverUrl($transaction->product) }}" alt="{{ $transaction->product->name }}">
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-white">{{ $transaction->product->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-300">{{ $transaction->creator ? $transaction->creator->name : 'Unknown' }}</div>
                                            <div class="text-sm text-gray-500">{{ $transaction->creator->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-yellow-500 font-bold">Rp {{ number_format($transaction->total_price) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($transaction->is_paid)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Paid
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                            {{ $transaction->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($transaction->is_paid)
                                                <a href="{{ route('pelaku_umkm.download', $transaction) }}" class="text-green-400 hover:text-green-300">Download</a>
                                            @else
                                                <span class="text-gray-500">Waiting Payment</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="bg-gray-800 border-2 border-dashed border-gray-600 rounded-lg p-8">
                            <div class="text-gray-500 text-6xl mb-4">💳</div>
                            <h3 class="text-gray-400 text-xl font-semibold mb-2">Belum ada transaksi.</h3>
                            <p class="text-gray-500">Transaksi pembelian akan muncul di sini ketika Anda membeli produk dari pelaku UMKM lain.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout> 
