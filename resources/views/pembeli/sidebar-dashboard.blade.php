@extends('front.layouts.app')
@section('title', 'lapakjmb'|'pembeli.dashboard') {{-- title atas --}}
@section('content')

    {{-- karena di dlm compponent maka manggilnya sprti ini --}}
    <x-navbar />

    <header
        class="w-full pt-[74px] pb-[34px] bg-[url('{{ asset('images/backgrounds/hero-image-1.png') }}')] bg-cover bg-no-repeat bg-center relative z-0">
        <div class="container max-w-[1130px] mx-auto flex flex-col items-center justify-center gap-[34px] z-10">
            <div class="flex flex-col gap-2 text-center w-fit mt-20 z-10">
                <h1 class="font-semibold text-[60px] leading-[130%]">Explore Lapak UMKM<br>Digital Products Di Jambi</h1>
                <p class="text-lg text-lapakjmb-grey">Change the way you work to achieve better results.</p>
            </div>
            <div class="flex w-full justify-center mb-[34px] z-10">
                <form action="{{ route('front.search') }}" method="GET"
                    class="group/search-bar p-[14px_18px] bg-belibang-darker-grey ring-1 ring-[#414141] hover:ring-[#888888] max-w-[560px] w-full rounded-full transition-all duration-300">
                    <div class="relative text-left">
                        <button class="absolute inset-y-0 left-0 flex items-center">
                            <img src="{{ asset('images/icons/search-normal.svg') }}" alt="icon">
                        </button>
                        <input name="keyword" type="text" id="searchInput"
                            class="bg-belibang-darker-grey w-full pl-[36px] focus:outline-none placeholder:text-[#595959] pr-9"
                            placeholder="Type anything to search..." />
                        <input name="keyword" type="reset" id="resetButton"
                            class="close-button hidden w-[38px] h-[38px] shrink-0 bg-[url('{{ asset('images/icons/close.svg') }}')] hover:bg-[url('{{ asset('images/icons/close-white.svg') }}')] transition-all duration-300 appearance-none transform -translate-x-1/2 -translate-y-1/2 absolute top-1/2 -right-5"
                            value="">
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full h-full absolute top-0 bg-gradient-to-b from-belibang-black/70 to-belibang-black z-0"></div>
    </header>

    {{-- My Purchases Section --}}
    @if(isset($myPurchases) && $myPurchases->count() > 0)
        <section class="container max-w-[1130px] mx-auto mb-[102px] flex flex-col gap-8">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-[32px]">My Purchases</h2>
                <a href="{{ route('pembeli.purchases') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg">
                    View All Purchases
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($myPurchases->take(3) as $purchase)
                    <div class="product-card flex flex-col rounded-[18px] bg-[#181818] overflow-hidden border border-gray-700">
                        <div class="thumbnail w-full h-[180px] flex shrink-0 overflow-hidden relative">
                            <img src="{{ \App\Helpers\ImageHelper::getProductCoverUrl($purchase->product) }}" class="w-full h-full object-cover" alt="thumbnail">
                            <div class="absolute top-3 right-3 z-10">
                                @if($purchase->is_paid)
                                    <span class="backdrop-blur bg-green-500/80 rounded-[4px] p-[4px_8px] text-white text-sm">
                                        Paid
                                    </span>
                                @else
                                    <span class="backdrop-blur bg-yellow-500/80 rounded-[4px] p-[4px_8px] text-white text-sm">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-white mb-2">{{ $purchase->product->name }}</h3>
                            <p class="text-yellow-500 font-bold mb-2">Rp {{ number_format($purchase->total_price) }}</p>
                            <p class="text-gray-400 text-sm mb-3">Pelaku UMKM: {{ $purchase->creator ? $purchase->creator->name : 'Unknown' }}</p>
                            <div class="flex justify-between items-center">
                                @if($purchase->is_paid)
                                    <a href="{{ route('pembeli.download', $purchase) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm">
                                        Download
                                    </a>
                                @else
                                    <span class="text-gray-500 text-sm">Waiting payment confirmation</span>
                                @endif
                                <a href="{{ route('front.details', $purchase->product->slug) }}" class="text-blue-400 hover:text-blue-300 text-sm">
                                    View Product
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <x-category-section />

    <section id="NewProduct" class="container max-w-[1130px] mx-auto mb-[102px] flex flex-col gap-8">
        <h2 class="font-semibold text-[32px]">New Product</h2>
        <div class="grid grid-cols-4 gap-[22px]">

            @forelse ($products as $product)
    <div class="product-card flex flex-col rounded-[18px] bg-[#181818] overflow-hidden">
        <a href="{{ route('front.details', $product->slug) }}"
            class="thumbnail w-full h-[180px] flex shrink-0 overflow-hidden relative">
            <img src="{{ Storage::url($product->cover) }}" class="w-full h-full object-cover" alt="thumbnail">
            <p class="backdrop-blur bg-black/30 rounded-[4px] p-[4px_8px] absolute top-3 right-[14px] z-10">
                Rp {{ number_format($product->price) }}
            </p>
        </a>
        <div class="p-[18px] flex flex-col gap-[8px]">
            <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
            <p class="text-lapakjmb-grey text-sm line-clamp-2">{{ $product->about }}</p>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-[8px]">
                    <img src="{{ Storage::url($product->creator->avatar) }}" class="w-[24px] h-[24px] rounded-full" alt="avatar">
                    <span class="text-sm text-lapakjmb-grey">{{ $product->creator ? $product->creator->name : 'Unknown' }}</span>
                </div>
                <a href="{{ route('front.details', $product->slug) }}"
                    class="bg-img-purple-to-orange text-white px-[18px] py-[8px] rounded-full text-sm hover:opacity-80 transition-all duration-300">
                    Buy Now
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-4 text-center py-12">
        <p class="text-lapakjmb-grey">No products available.</p>
    </div>
@endforelse

        </div>
    </section>

    <x-testimonials />
    <x-footer />

@endsection

@push('after-script')
    <script>
        $('.testi-carousel').flickity({
            // options
            cellAlign: 'left',
            contain: true,
            pageDots: false,
            prevNextButtons: false,
        });

        // previous
        $('.btn-prev').on('click', function() {
            $('.testi-carousel').flickity('previous', true);
        });

        // next
        $('.btn-next').on('click', function() {
            $('.testi-carousel').flickity('next', true);
        });
    </script>

    <script>
        const searchInput = document.getElementById('searchInput');
        const resetButton = document.getElementById('resetButton');

        searchInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                resetButton.classList.remove('hidden');
            } else {
                resetButton.classList.add('hidden');
            }
        });

        resetButton.addEventListener('click', function() {
            resetButton.classList.add('hidden');
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuButton = document.getElementById('menu-button');
            const dropdownMenu = document.querySelector('.dropdown-menu');

            menuButton.addEventListener('click', function() {
                dropdownMenu.classList.toggle('hidden');
            });

            // Close the dropdown menu when clicking outside of it
            document.addEventListener('click', function(event) {
                const isClickInside = menuButton.contains(event.target) || dropdownMenu.contains(event
                    .target);
                if (!isClickInside) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        });
    </script>
@endpush
