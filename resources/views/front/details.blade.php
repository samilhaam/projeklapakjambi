{{-- tampilan untuk checkout /keranjang --}}
@extends('front.layouts.app')
@section('title', 'lapakjmb') {{-- title atas --}}
@section('content')

    {{-- karena di dlm compponent maka manggilnya sprti ini --}}
    <x-navbar />


    <header class="w-full pt-[74px] pb-[103px] relative z-0">
        <div class="container max-w-[1130px] mx-auto flex flex-col z-10">
            <div class="flex flex-col gap-4 mt-7 z-10">
                <p class="bg-[#2A2A2A] font-semibold text-lapakjmb-grey rounded-[4px] p-[8px_16px] w-fit">
                    {{ $product->Category->name }}</p>
                <h1 class="font-semibold text-[55px]">{{ $product->name }}
                </h1>
            </div>
        </div>
        <div class="background-image w-full h-full absolute top-0 overflow-hidden z-0">
            <img src="{{ asset('images/backgrounds/heroo.png') }}" class="w-full h-full object-cover" alt="hero image">
        </div>
        <div class="w-full h-1/3 absolute bottom-0 bg-gradient-to-b from-belibang-black/0 to-belibang-black z-0"></div>
        <div class="w-full h-full absolute top-0 bg-belibang-black/95 z-0"></div>
    </header>

    <section id="DetailsContent" class="container max-w-[1130px] mx-auto mb-[32px] relative -top-[70px]">
        <div class="flex flex-col gap-8">
            <div class="w-[1130px] h-[700px] flex shrink-0 rounded-[20px] overflow-hidden">
                <img src="{{ \App\Helpers\ImageHelper::getProductCoverUrl($product) }}" class="w-full h-full object-cover" alt="hero image">
            </div>
            <div class="flex gap-8 relative -mt-[93px]">
                <div class="flex flex-col p-[30px] gap-5 bg-[#181818] rounded-[20px] w-[700px] shrink-0 mt-[90px] h-fit">
                    <div class="flex flex-col gap-4">
                        <p class="font-semibold text-xl">Overview</p>
                        <p class="text-lapakjmb-grey leading-[30px]">{{ $product->about }}</p>
                        
                    </div>
                </div>
                <div class="flex flex-col w-[366px] gap-[30px] flex-nowrap overflow-y-visible">
                    <div class="p-[2px] bg-img-purple-to-orange rounded-[20px] flex w-full h-fit">
                        <div class="w-full p-[28px] bg-[#181818] rounded-[20px] flex flex-col gap-[26px]">
                            <div class="flex flex-col gap-3">
                                <p
                                    class="font-semibold text-4xl bg-clip-text text-transparent bg-gradient-to-r from-[#B05CB0] to-[#FCB16B]">
                                    Rp. {{ number_format($product->price) }}
                                </p>
                                
                            </div>

                            <a href="{{ route('front.checkout', $product->slug) }}"
                                class="bg-[#2D68F8] text-center font-semibold p-[12px_20px] rounded-full hover:bg-[#083297] active:bg-[#062162] transition-all duration-300">Checkout</a>

                        </div>
                    </div>
                    <div class="w-full p-[30px] bg-[#181818] rounded-[20px] flex flex-col gap-4 h-fit">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-3 items-center">
                                <div class="w-12 h-12 rounded-full overflow-hidden flex shrink-0">
                                    <img src="{{ Storage::url($product->Creator->avatar) }}" alt="icon">
                                </div>
                                <div class="flex flex-col gap-[2px]">
                                    <p class="font-semibold">{{ $product->Creator ? $product->Creator->name : 'Unknown' }}</p>
                                    <p class="text-[#595959] text-sm leading-[18px]">
                                        <span class="font-semibold mr-1">{{ count($total_products) }}</span>
                                        Product
                                    </p>
                                </div>
                            </div>
                            <a href="">
                                <img src="{{ asset('images/icons/arrow-right.svg') }}" alt="icon">
                            </a>
                        </div>
                        <p class="text-sm leading-[24px] text-lapakjmb-grey">nikmati hidangan tungku nyai untuk mendapatkan kelezatan yang kami beri</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="NewProduct" class="container max-w-[1130px] mx-auto mb-[102px] flex flex-col gap-8">
        <h2 class="font-semibold text-[32px]">More Product</h2>
        <div class="grid grid-cols-4 gap-[22px]">
            @forelse ($other_products as $other_product)
                <div class="product-card flex flex-col rounded-[18px] bg-[#181818] overflow-hidden">
                    <a href="{{ route('front.details', $other_product->slug) }}"
                        class="thumbnail w-full h-[180px] flex shrink-0 overflow-hidden relative">
                        <img src="{{ \App\Helpers\ImageHelper::getProductCoverUrl($other_product) }}" class="w-full h-full object-cover"
                            alt="thumbnail">
                        <p class="backdrop-blur bg-black/30 rounded-[4px] p-[4px_8px] absolute top-3 right-[14px] z-10">Rp.
                            {{ number_format($other_product->price) }}0</p>
                    </a>
                    <div class="p-[10px_14px_12px] h-full flex flex-col justify-between gap-[14px]">
                        <div class="flex flex-col gap-1">
                            <a href=""
                                class="font-semibold line-clamp-2 hover:line-clamp-none">{{ $other_product->name }}r</a>
                            <p
                                class="bg-[#2A2A2A] font-semibold text-xs text-lapakjmb-grey rounded-[4px] p-[4px_6px] w-fit">
                                {{ $other_product->Category->name }}</p>
                        </div>
                        <div class="flex items-center gap-[6px]">
                            <div class="w-6 h-6 flex shrink-0 items-center justify-center rounded-full overflow-hidden">
                                <img src="{{ asset('images/logos/framer.png') }}" class="w-full h-full object-cover"
                                    alt="logo">
                            </div>
                            <a href=""
                                class="font-semibold text-xs text-lapakjmb-grey">{{ $other_product->Creator ? $other_product->Creator->name : 'Unknown' }}</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Belum ada product lain</p>
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
