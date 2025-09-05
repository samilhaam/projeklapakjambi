<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function Creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Get all orders for this product
     */
    public function orders()
    {
        return $this->hasMany(ProductOrder::class);
    }

    /**
     * Get all images for this product
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the primary image for this product
     */
    public function primaryImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    /**
     * Get cover images for this product
     */
    public function coverImages()
    {
        return $this->hasMany(ProductImage::class)->where('image_type', 'cover');
    }

    /**
     * Get gallery images for this product
     */
    public function galleryImages()
    {
        return $this->hasMany(ProductImage::class)->where('image_type', 'gallery');
    }

    /**
     * Get thumbnail images for this product
     */
    public function thumbnailImages()
    {
        return $this->hasMany(ProductImage::class)->where('image_type', 'thumbnail');
    }

    /**
     * Get the main cover image URL (backward compatibility)
     */
    public function getCoverUrlAttribute()
    {
        try {
            $primaryImage = $this->primaryImage()->first();
            if ($primaryImage) {
                return $primaryImage->image_url;
            }
            
            // Fallback to old cover field
            if ($this->cover) {
                return \App\Helpers\ImageHelper::getImageUrl($this->cover);
            }
            
            return asset('images/thumbnails/img1.png');
        } catch (\Exception $e) {
            // If there's any error, fallback to old cover field
            if ($this->cover) {
                return \App\Helpers\ImageHelper::getImageUrl($this->cover);
            }
            return asset('images/thumbnails/img1.png');
        }
    }
}
