<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        $products = Product::where('creator_id', Auth::id())->get(); // cari data berdasarkan creator id
        
            // Cek apakah request dari admin atau pelaku_umkm
        if (request()->route()->getPrefix() === 'admin') {
            return view('admin.products.index', [
                'products' => $products,
            ]);
        } else {
                return view('pelaku_umkm.products.index', [
                'products' => $products,
            ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading products: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        
        // Cek apakah request dari admin atau pelaku_umkm
        if (request()->route()->getPrefix() === 'admin') {
            return view('admin.products.create', [
                'categories' => $categories,
            ]);
        } else {
            return view('pelaku_umkm.products.create', [
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cover' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'path_file' => ['required', 'file', 'mimes:zip'],
            'about' => ['required', 'string', 'max:65535'],
            'category_id' => ['required', 'integer', 'max:65535'],
            'price' => ['required', 'integer', 'min:0'],
        ]);

        DB::beginTransaction();

        try {
            // Create product first
            $validated['slug'] = Str::slug($request->name);
            $validated['creator_id'] = Auth::id();
            
            // Keep the old cover field for backward compatibility
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                $validated['cover'] = $coverPath;
            }

            if ($request->hasFile('path_file')) {
                $path_FilePath = $request->file('path_file')->store('product_files', 'public');
                $validated['path_file'] = $path_FilePath;
            }

            $newProduct = Product::create($validated);

            // Store image in new product_images table
            if ($request->hasFile('cover')) {
                \App\Helpers\ImageHelper::storeProductImage(
                    $request->file('cover'), 
                    $newProduct->id, 
                    'cover', 
                    true // Set as primary image
                );
            }

            DB::commit();

            // Cek apakah request dari admin atau pelaku_umkm
            if (request()->route()->getPrefix() === 'admin') {
                return redirect()->route('admin.products.index')->with('success', 'Product Created SuccessFuly');
            } else {
                return redirect()->route('pelaku_umkm.products.index')->with('success', 'Product Created SuccessFuly');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System_Error' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        try {
        $categories = Category::all();
            
            // Cek apakah request dari admin atau pelaku_umkm
            if (request()->route()->getPrefix() === 'admin') {
        return view('admin.products.edit', [
            'product' => $product,
                    'categories' => $categories,
                ]);
            } else {
                return view('pelaku_umkm.products.edit', [
                    'product' => $product,
                    'categories' => $categories,
        ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading product: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'cover' => ['sometimes', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'path_file' => ['sometimes', 'file', 'mimes:zip'],
            'about' => ['required', 'string', 'max:65535'],
            'category_id' => ['required', 'integer', 'max:65535'],
            'price' => ['required', 'integer', 'min:0'],
        ]);
        
        DB::beginTransaction();
        try {
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('product_covers', 'public');
                if ($product->cover) {
                    Storage::disk('public')->delete($product->cover);
                }
                $validated['cover'] = $coverPath;
                
                // Also store in new product_images table
                \App\Helpers\ImageHelper::storeProductImage(
                    $request->file('cover'), 
                    $product->id, 
                    'cover', 
                    true // Set as primary image
                );
            }
            
            if ($request->hasFile('path_file')) {
                $path_FilePath = $request->file('path_file')->store('product_files', 'public');
                if ($product->path_file) {
                    Storage::disk('public')->delete($product->path_file);
                }
                $validated['path_file'] = $path_FilePath;
            }
            
            $validated['slug'] = Str::slug($request->name);
            $validated['creator_id'] = Auth::id();
            $product->update($validated);
            
            DB::commit();
            
            // Cek apakah request dari admin atau pelaku_umkm
            if (request()->route()->getPrefix() === 'admin') {
            return redirect()->route('admin.products.index')->with('success', 'Product Updated SuccessFuly');
            } else {
                return redirect()->route('pelaku_umkm.products.index')->with('success', 'Product Updated SuccessFuly');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System_Error' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // dd($product);
        try {
            $product->delete();
            
            // Cek apakah request dari admin atau pelaku_umkm
            if (request()->route()->getPrefix() === 'admin') {
            return redirect()->route('admin.products.index')->with('success', 'Deleted Product Successfully');
            } else {
                return redirect()->route('pelaku_umkm.products.index')->with('success', 'Deleted Product Successfully');
            }
        } catch (\Exception $e) {
            $error = ValidationException::withMessages([
                'system_error' => ['System_Error' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
