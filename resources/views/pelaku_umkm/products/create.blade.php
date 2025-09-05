<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm p-10 sm:rounded-lg">
                <form method="POST" action="{{ route('pelaku_umkm.products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <a href="{{ route('pelaku_umkm.products.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white font-medium text-sm rounded-md shadow hover:bg-indigo-500 transition-all duration-300 mb-6">
                            ← Back to My Products
                        </a>

                    <h1 class="text-white font-bold text-3xl">Add New Product</h1>

                    <div class="mt-4">
                        <x-input-label for="cover" :value="__('Cover')" class="text-white" />
                        <x-text-input id="cover" class="block mt-1 w-full text-white bg-gray-800 border-gray-100" type="file" name="cover" required />
                        <x-input-error :messages="$errors->get('cover')" class="mt-2 text-red-400" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="path_file" :value="__('path_file')" class="text-white" />
                        <x-text-input id="path_file" class="block mt-1 w-full text-white bg-gray-800 border-gray-700" type="file" name="path_file" required />
                        <x-input-error :messages="$errors->get('path_file')" class="mt-2 text-red-400" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Name')" class="text-white" />
                        <x-text-input id="name" class="block mt-1 w-full text-white bg-gray-800 border-gray-700" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="price" :value="__('price')" class="text-white" />
                        <x-text-input id="price" class="block mt-1 w-full text-white bg-gray-800 border-gray-700" type="number" name="price"
                            :value="old('price')" required autofocus autocomplete="price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2 text-red-400" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category" :value="__('category')" class="text-white" />
                        <select name="category_id" class="w-full py-2 pl-5 border border-gray-700 rounded bg-gray-800 text-white">
                            <option value="">Select category</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @empty
                                <option disabled>Data kategori tidak ada</option>
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2 text-red-400" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('about')" class="text-white" />
                        <textarea name="about" id="about" class="w-full py-2 pl-5 border border-gray-700 rounded bg-gray-800 text-white"></textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2 text-red-400" />
                    </div>

                    <div class="flex items-center justify-start mt-4">
                        <x-primary-button class="!w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                            {{ __('Add Product') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 
