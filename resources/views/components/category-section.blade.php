<section class="container max-w-[1130px] mx-auto mb-[102px] flex flex-col gap-8">
    <h2 class="font-semibold text-[32px] text-white">Category</h2>
    <div class="flex flex-wrap gap-4 justify-center">
        <!-- All Products -->
        <a href="{{ route('front.index') }}"
            class="group category-card w-fit h-fit p-[1px] rounded-2xl bg-img-transparent hover:bg-img-purple-to-orange transition-all duration-300">
            <div
                class="flex flex-col p-[18px] rounded-2xl w-[210px] bg-img-black-gradient group-active:bg-img-black transition-all duration-300">
                <div class="w-[58px] h-[58px] flex shrink-0 items-center justify-center">
                    <img src="{{ asset('images/icons/cart.svg') }}" alt="All Products">
                </div>
                <div class="px-[6px] flex flex-col text-left">
                    <p class="font-bold text-sm text-white">All Products</p>
                    <p class="text-xs text-lapakjmb-grey">Everything in One Place</p>
                </div>
            </div>
        </a>

        @foreach($categories as $category)
            <a href="{{ route('front.category', $category) }}"
                class="group category-card w-fit h-fit p-[1px] rounded-2xl bg-img-transparent hover:bg-img-purple-to-orange transition-all duration-300">
                <div
                    class="flex flex-col p-[18px] rounded-2xl w-[210px] bg-img-black-gradient group-active:bg-img-black transition-all duration-300">
                    <div class="w-[58px] h-[58px] flex shrink-0 items-center justify-center">
                        @php
                            $hasStoredIcon = $category->icon && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->icon);
                            $normalizedName = \Illuminate\Support\Str::lower(trim($category->name));
                        @endphp
                        @if($hasStoredIcon)
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="w-8 h-8">
                        @else
                            <!-- Default icons based on normalized category name -->
                            @switch($normalizedName)
                                @case('food')
                                    <img src="{{ asset('images/icons/food.svg') }}" alt="{{ $category->name }}" class="w-8 h-8 object-contain">
                                    @break
                                @case('fashion')
                                    <img src="{{ asset('images/icons/fashion.svg') }}" alt="{{ $category->name }}" class="w-8 h-8 object-contain">
                                    @break
                                @case('gadget')
                                    <img src="{{ asset('images/icons/hp.svg') }}" alt="{{ $category->name }}" class="w-8 h-8 object-contain">
                                    @break
                                @case('makeup')
                                    <img src="{{ asset('images/icons/mascara.svg') }}" alt="{{ $category->name }}" class="w-8 h-8 object-contain">
                                    @break
                                @case('digital art')
                                    <img src="{{ asset('images/icons/gallery.svg') }}" alt="{{ $category->name }}" class="w-8 h-8 object-contain">
                                    @break
                                @case('templates')
                                    <img src="{{ asset('images/icons/document-upload.svg') }}" alt="{{ $category->name }}" class="w-8 h-8 object-contain">
                                    @break
                                @case('e-books')
                                    <img src="{{ asset('images/icons/document-upload.svg') }}" alt="{{ $category->name }}" class="w-8 h-8 object-contain">
                                    @break
                                @case('courses')
                                    <img src="{{ asset('images/icons/user-square.svg') }}" alt="{{ $category->name }}" class="w-8 h-8 object-contain">
                                    @break
                                @default
                                    <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">{{ substr($category->name, 0, 1) }}</span>
                                    </div>
                            @endswitch
                        @endif
                    </div>
                    <div class="px-[6px] flex flex-col text-left">
                        <p class="font-bold text-sm text-white">{{ $category->name }}</p>
                        <p class="text-xs text-lapakjmb-grey">{{ $category->description ?? 'Explore ' . $category->name }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
