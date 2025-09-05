<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 overflow-hidden shadow-sm p-6 sm:rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-white font-bold text-3xl">Edit Product</h1>
                    <a href="{{ route('pelaku_umkm.products.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        ← Back to Products
                    </a>
                </div>

                <!-- Product Form -->
                <form method="POST" action="{{ route('pelaku_umkm.products.update', $product) }}" enctype="multipart/form-data" class="mb-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-white mb-2">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ $product->name }}" required
                                class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-white mb-2">Category</label>
                            <select name="category_id" id="category_id" required
                                class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-white mb-2">Price</label>
                            <input type="number" name="price" id="price" value="{{ $product->price }}" required
                                class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="cover" class="block text-sm font-medium text-white mb-2">Cover Image</label>
                            <input type="file" name="cover" id="cover" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @if($product->cover)
                                <p class="text-sm text-gray-400 mt-1">Current: {{ basename($product->cover) }}</p>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <label for="about" class="block text-sm font-medium text-white mb-2">Description</label>
                            <textarea name="about" id="about" rows="4" required
                                class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $product->about }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label for="path_file" class="block text-sm font-medium text-white mb-2">Product File (ZIP)</label>
                            <input type="file" name="path_file" id="path_file" accept=".zip"
                                class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @if($product->path_file)
                                <p class="text-sm text-gray-400 mt-1">Current: {{ basename($product->path_file) }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Product
                        </button>
                    </div>
                </form>

                <!-- Image Management Section -->
                <div class="border-t border-gray-700 pt-8">
                    <h3 class="text-white font-bold text-xl mb-4">Product Images</h3>
                    
                    <!-- Current Images -->
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                        @if($product->images && $product->images->count() > 0)
                            @foreach($product->images as $image)
                                <div class="relative group">
                                    <img src="{{ $image->image_url }}" alt="{{ $image->alt_text }}" 
                                         class="w-full h-32 object-cover rounded border-2 {{ $image->is_primary ? 'border-yellow-400' : 'border-gray-600' }}">
                                    
                                    @if($image->is_primary)
                                        <span class="absolute top-2 left-2 bg-yellow-500 text-black text-xs px-2 py-1 rounded">Primary</span>
                                    @endif
                                    
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <button onclick="deleteImage({{ $image->id }})" 
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-span-full text-center py-8">
                                <p class="text-gray-400">No images uploaded yet.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Upload New Image -->
                    <form id="imageUploadForm" class="border border-gray-600 rounded p-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="new_image" class="block text-sm font-medium text-white mb-2">Upload Image</label>
                                <input type="file" name="image" id="new_image" accept="image/*" required
                                    class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            
                            <div>
                                <label for="image_type" class="block text-sm font-medium text-white mb-2">Image Type</label>
                                <select name="image_type" id="image_type" required
                                    class="w-full px-3 py-2 border border-gray-600 rounded-md bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="cover">Cover</option>
                                    <option value="gallery">Gallery</option>
                                    <option value="thumbnail">Thumbnail</option>
                                </select>
                            </div>
                            
                            <div class="flex items-end">
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_primary" id="is_primary" class="mr-2">
                                    <span class="text-white text-sm">Set as Primary</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Upload Image
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Image upload handling
        document.getElementById('imageUploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('{{ route("pelaku_umkm.products.images.store", $product) }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while uploading the image.');
            });
        });

        // Delete image
        function deleteImage(imageId) {
            if (confirm('Are you sure you want to delete this image?')) {
                fetch('{{ route("pelaku_umkm.products.images.destroy", ["product" => $product, "image" => ":imageId"]) }}'.replace(':imageId', imageId), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the image.');
                });
            }
        }
    </script>
</x-app-layout> 
