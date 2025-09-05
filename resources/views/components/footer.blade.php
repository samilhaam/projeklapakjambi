<footer class="bg-[#181818] py-[34px]">
    <div class="container max-w-[1130px] mx-auto flex flex-col gap-[66px]">
        <div class="flex justify-between">
            <div class="flex flex-col justify-between">
                <div class="flex shrink-0">
                    <img src="{{ asset('images/logos/logolapakjambi.png') }}" alt="logo">
                </div>
                @if(auth()->check() && auth()->user()->role === 'pelaku_umkm')
                    <div class="flex flex-col gap-[10px]">
                        <p class="font-semibold text-sm">Connect with us</p>
                        <div class="flex items-center gap-5">
                            <a href="https://wa.me/62895636486733" target="_blank" rel="noopener"
                                class="w-9 h-9 flex shrink-0 rounded-full overflow-hidden border border-[#595959] items-center justify-center">
                                <img src="{{ asset('images/iconscopy/ydntkwia.svg') }}" class="w-6 h-6" alt="WhatsApp">
                            </a>
                            <a href="https://facebook.com/yourpage" target="_blank" rel="noopener"
                                class="w-9 h-9 flex shrink-0 rounded-full overflow-hidden border border-[#595959] items-center justify-center">
                                <img src="{{ asset('images/logos/facebook.svg') }}" class="w-6 h-6" alt="Facebook">
                            </a>
                            <a href="https://instagram.com/___malvelindo" target="_blank" rel="noopener"
                                class="w-9 h-9 flex shrink-0 rounded-full overflow-hidden border border-[#595959] items-center justify-center">
                                <img src="{{ asset('images/logos/strangehelix.svg') }}" class="w-6 h-6" alt="Instagram">
                            </a>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-lapakjmb-grey mt-2">
                            <span>Hubungi:</span>
                            <a href="tel:+62895636486733" class="hover:text-white transition-all duration-300">+62 895-6364-86733</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="flex gap-[72px]">
                <div class="flex flex-col gap-8">
                    <p class="font-semibold text-sm">Browse</p>
                    <div class="flex flex-col gap-[18px]">
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">All Products</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Food</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Fashion</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Gadget</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Makeup</a>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="font-semibold text-sm">Platform</p>
                    <div class="flex flex-col gap-[18px]">
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">All-Access Pass</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Become an author</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Affiliate program</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Terms & Licensing</a>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="font-semibold text-sm">Customer service</p>
                    <div class="flex flex-col gap-[18px]">
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">FAQ</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Orders</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Payments</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">refunds</a>
                    </div>
                </div>
                <div class="flex flex-col gap-8">
                    <p class="font-semibold text-sm">Contact us</p>
                    <div class="flex flex-col gap-[18px]">
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">About us</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Company</a>
                        <a href="" class="text-lapakjmb-grey font-semibold text-xs">Careers</a>
                    </div>
                </div>
            </div>
        </div>
        <p class="text-[10px] text-[#595959]">© 2025, LapakJambi LLC.</p>
    </div>
</footer>
