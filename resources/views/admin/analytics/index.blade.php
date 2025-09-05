@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black analytics-page">
    <header class="bg-gradient-to-r from-gray-800 to-gray-900 border-b border-gray-700 shadow">
        <div class="w-full max-w-screen-xl mx-auto px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 rounded-md bg-gradient-to-r from-blue-500 to-purple-600">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold text-white">Dashboard Analitik</h1>
                        <p class="text-sm text-gray-400">Ringkasan metrik marketplace</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="w-full max-w-screen-xl mx-auto px-4 py-6 mt-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="rounded-lg p-4 bg-gradient-to-br from-blue-500 to-blue-600">
                <p class="text-blue-100 text-sm">Pengguna Baru (30h)</p>
                <p class="text-2xl font-bold text-white">{{ $userGrowth->sum('count') ?? 0 }}</p>
            </div>
            <div class="rounded-lg p-4 bg-gradient-to-br from-green-500 to-green-600">
                <p class="text-green-100 text-sm">Pesanan (30h)</p>
                <p class="text-2xl font-bold text-white">{{ $orderTrends->sum('count') ?? 0 }}</p>
            </div>
            <div class="rounded-lg p-4 bg-gradient-to-br from-yellow-500 to-yellow-600">
                <p class="text-yellow-100 text-sm">Pendapatan (30h)</p>
                <p class="text-2xl font-bold text-white">Rp {{ number_format($orderTrends->sum('revenue') ?? 0, 0, ',', '.') }}</p>
            </div>
            <div class="rounded-lg p-4 bg-gradient-to-br from-purple-500 to-purple-600">
                <p class="text-purple-100 text-sm">Kategori Aktif</p>
                <p class="text-2xl font-bold text-white">{{ $categoryPerformance->count() ?? 0 }}</p>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-700">
                <h3 class="text-white font-semibold">Kinerja Kategori</h3>
            </div>
            <div class="p-4">
                <div class="table-responsive">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-gray-400 border-b border-gray-700">
                                <th class="pb-3 font-medium">Kategori</th>
                                <th class="pb-3 font-medium text-center">Produk</th>
                                <th class="pb-3 font-medium text-right">Total Nilai</th>
                                <th class="pb-3 font-medium text-center">Kinerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(($categoryPerformance ?? []) as $category)
                            <tr class="border-b border-gray-700">
                                <td class="py-3 text-white">{{ $category->name }}</td>
                                <td class="py-3 text-center text-gray-300">{{ $category->products_count }}</td>
                                <td class="py-3 text-right text-gray-300">Rp {{ number_format($category->products_sum_price ?? 0, 0, ',', '.') }}</td>
                                <td class="py-3 text-center">
                                    @php
                                        $maxProducts = ($categoryPerformance->max('products_count') ?? 0);
                                        $percentage = $maxProducts > 0 ? ($category->products_count / $maxProducts) * 100 : 0;
                                    @endphp
                                    <div class="w-full bg-gray-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-3 rounded-full" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-400">{{ number_format($percentage, 1) }}%</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.analytics-page { padding-top: 8rem; }
@media (min-width: 1024px) { .analytics-page { padding-top: 12rem; } }
@media (min-width: 1280px) { .analytics-page { padding-top: 13rem; } }
</style>
@endsection


