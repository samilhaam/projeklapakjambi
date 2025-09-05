<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    /**
     * Get image URL with fallback
     */
    public static function getImageUrl($path, $fallback = null)
    {
        if (!$path) {
            return $fallback ?? asset('images/thumbnails/img1.png');
        }

        // Normalize path
        // - If it's a full URL, return as-is
        if (preg_match('/^https?:\/\//i', $path)) {
            return $path;
        }

        // - Strip leading 'storage/' if accidentally stored that way in DB
        $normalizedPath = preg_replace('/^storage\//', '', $path);

        // Check if file exists in storage (public disk)
        if (Storage::disk('public')->exists($normalizedPath)) {
            return Storage::url($normalizedPath);
        }

        // Also try raw path as a fallback check
        if (Storage::disk('public')->exists($path)) {
            return Storage::url($path);
        }

        // Return fallback if file doesn't exist
        return $fallback ?? asset('images/thumbnails/img1.png');
    }

    /**
     * Get product cover image URL
     */
    public static function getProductCoverUrl($product)
    {
        if (!$product) {
            return asset('images/thumbnails/img1.png');
        }

        try {
            // Try to get primary image from new product_images table
            $primaryImage = $product->primaryImage()->first();
            if ($primaryImage) {
                return $primaryImage->image_url;
            }

            // Fallback to old cover field
            if ($product->cover) {
                return self::getImageUrl($product->cover);
            }

            return asset('images/thumbnails/img1.png');
        } catch (\Exception $e) {
            // If there's any error, fallback to old cover field
            if ($product->cover) {
                return self::getImageUrl($product->cover);
            }
            return asset('images/thumbnails/img1.png');
        }
    }

    /**
     * Get product image URL from ProductImage model
     */
    public static function getProductImageUrl($productImage)
    {
        if (!$productImage) {
            return asset('images/thumbnails/img1.png');
        }

        return self::getImageUrl($productImage->image_path);
    }

    /**
     * Get user avatar URL
     */
    public static function getUserAvatarUrl($user)
    {
        if (!$user || !$user->avatar) {
            return asset('images/thumbnails/img1.png');
        }

        return self::getImageUrl($user->avatar);
    }

    /**
     * Store product image and return ProductImage model
     */
    public static function storeProductImage($file, $productId, $type = 'gallery', $isPrimary = false)
    {
        // Store in product_covers for backward compatibility
        $imagePath = $file->store('product_covers', 'public');
        $imageName = $file->getClientOriginalName();

        return \App\Models\ProductImage::create([
            'product_id' => $productId,
            'image_path' => $imagePath,
            'image_name' => $imageName,
            'image_type' => $type,
            'is_primary' => $isPrimary,
            'alt_text' => $imageName
        ]);
    }

    /**
     * Check if image exists and return URL
     */
    public static function getImageUrlSafe($path)
    {
        if (!$path) {
            return asset('images/thumbnails/img1.png');
        }

        // Try to get the URL
        $url = Storage::url($path);
        
        // Check if file actually exists
        if (Storage::disk('public')->exists($path)) {
            return $url;
        }

        return asset('images/thumbnails/img1.png');
    }
} 