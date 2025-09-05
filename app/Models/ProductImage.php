<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
        'image_name',
        'image_type',
        'sort_order',
        'is_primary',
        'alt_text'
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Get the product that owns the image
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the full URL for the image
     */
    public function getImageUrlAttribute()
    {
        return \App\Helpers\ImageHelper::getImageUrl($this->image_path);
    }

    /**
     * Scope for primary images
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * Scope for cover images
     */
    public function scopeCover($query)
    {
        return $query->where('image_type', 'cover');
    }

    /**
     * Scope for gallery images
     */
    public function scopeGallery($query)
    {
        return $query->where('image_type', 'gallery');
    }

    /**
     * Scope for thumbnail images
     */
    public function scopeThumbnail($query)
    {
        return $query->where('image_type', 'thumbnail');
    }
}
