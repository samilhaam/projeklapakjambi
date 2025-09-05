<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Helpers\ImageHelper;

class ProductImageController extends Controller
{
    /**
     * Display a listing of product images
     */
    public function index(Product $product)
    {
        $images = $product->images()->orderBy('sort_order')->get();
        return response()->json($images);
    }

    /**
     * Store a newly created image
     */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_type' => 'required|in:cover,gallery,thumbnail',
            'is_primary' => 'boolean',
            'alt_text' => 'nullable|string|max:255'
        ]);

        DB::beginTransaction();

        try {
            $image = ImageHelper::storeProductImage(
                $request->file('image'),
                $product->id,
                $request->image_type,
                $request->is_primary ?? false
            );

            // If this is set as primary, unset other primary images
            if ($request->is_primary) {
                $product->images()
                    ->where('id', '!=', $image->id)
                    ->update(['is_primary' => false]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully',
                'image' => $image
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified image
     */
    public function update(Request $request, Product $product, ProductImage $image)
    {
        $request->validate([
            'image_type' => 'sometimes|in:cover,gallery,thumbnail',
            'is_primary' => 'sometimes|boolean',
            'sort_order' => 'sometimes|integer|min:0',
            'alt_text' => 'sometimes|nullable|string|max:255'
        ]);

        DB::beginTransaction();

        try {
            $image->update($request->only(['image_type', 'is_primary', 'sort_order', 'alt_text']));

            // If this is set as primary, unset other primary images
            if ($request->is_primary) {
                $product->images()
                    ->where('id', '!=', $image->id)
                    ->update(['is_primary' => false]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Image updated successfully',
                'image' => $image
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified image
     */
    public function destroy(Product $product, ProductImage $image)
    {
        DB::beginTransaction();

        try {
            // Delete file from storage
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            // Delete database record
            $image->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reorder images
     */
    public function reorder(Request $request, Product $product)
    {
        $request->validate([
            'image_ids' => 'required|array',
            'image_ids.*' => 'integer|exists:product_images,id'
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->image_ids as $index => $imageId) {
                ProductImage::where('id', $imageId)
                    ->where('product_id', $product->id)
                    ->update(['sort_order' => $index]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Images reordered successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to reorder images: ' . $e->getMessage()
            ], 500);
        }
    }
}
