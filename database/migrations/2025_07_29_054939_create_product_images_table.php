<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('image_path'); // Path ke file gambar
            $table->string('image_name'); // Nama asli file
            $table->string('image_type')->default('gallery'); // cover, gallery, thumbnail
            $table->integer('sort_order')->default(0); // Urutan tampilan
            $table->boolean('is_primary')->default(false); // Apakah gambar utama
            $table->text('alt_text')->nullable(); // Alt text untuk accessibility
            $table->timestamps();
            
            // Index untuk performa
            $table->index(['product_id', 'image_type']);
            $table->index(['product_id', 'is_primary']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
