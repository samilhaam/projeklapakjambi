<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all products that have cover images
        $products = Product::whereNotNull('cover')->where('cover', '!=', '')->get();

        foreach ($products as $product) {
            // Check if product already has images in the new table
            $existingImage = ProductImage::where('product_id', $product->id)->first();
            
            if (!$existingImage) {
                // Create product image record
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $product->cover,
                    'image_name' => basename($product->cover),
                    'image_type' => 'cover',
                    'is_primary' => true,
                    'sort_order' => 0,
                    'alt_text' => $product->name . ' cover image'
                ]);
            }
        }

        $this->command->info('Product images migrated successfully!');
    }
}
