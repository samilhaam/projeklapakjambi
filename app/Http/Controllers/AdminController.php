<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistics
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = ProductOrder::count();
        $totalRevenue = ProductOrder::sum('total_price');
        
        // User distribution
        $usersByRole = [
            'pelaku_umkm' => User::where('role', 'pelaku_umkm')->count(),
            'pembeli' => User::where('role', 'pembeli')->count(),
            'admin' => User::where('role', 'admin')->count(),
        ];
        
        // Recent activities - with proper relationships and null checks
        $recentOrders = ProductOrder::with(['product', 'pembeli'])
            ->whereHas('product') // Only get orders with valid products
            ->whereHas('pembeli')   // Only get orders with valid buyers
            ->latest()
            ->take(5)
            ->get();
            
        $topProducts = Product::with(['creator'])
            ->withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts', 
            'totalOrders',
            'totalRevenue',
            'usersByRole',
            'recentOrders',
            'topProducts'
        ));
    }

    // User Management
    public function users()
    {
        $users = User::withCount(['products', 'orders'])->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function userShow(User $user)
    {
        $user->load(['products', 'orders']);
        return view('admin.users.show', compact('user'));
    }

    public function userEdit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function userUpdate(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,pelaku_umkm,pembeli',
            'is_active' => 'boolean'
        ]);

        $user->update($validated);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function userDestroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Cannot delete your own account');
        }
        
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    // Product Management
    public function products()
    {
        $products = Product::with(['creator', 'category'])->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function productCreate()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function productStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'creator_id' => Auth::id(),
            'is_active' => $request->has('is_active')
        ]);

        if ($request->hasFile('cover')) {
            $imagePath = \App\Helpers\ImageHelper::storeProductImage($request->file('cover'));
            $product->cover = $imagePath;
            $product->save();
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function productShow(Product $product)
    {
        $product->load(['creator', 'category', 'orders']);
        return view('admin.products.show', compact('product'));
    }

    public function productEdit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function productUpdate(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'is_active' => 'boolean'
        ]);

        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function productDestroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    // Order Management
    public function orders()
    {
        $orders = ProductOrder::with(['product', 'pembeli', 'product.creator', 'product.category'])
            ->latest()
            ->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function orderShow(ProductOrder $order)
    {
        $order->load(['product', 'pembeli', 'product.creator', 'product.category']);
        return view('admin.orders.show', compact('order'));
    }

    public function orderEdit(ProductOrder $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function orderUpdate(Request $request, ProductOrder $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update($validated);
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully');
    }

    // Category Management
    public function categories()
    {
        $categories = Category::withCount('products')->latest()->paginate(10);
        $stats = [
            'total' => Category::count(),
            'active' => Category::has('products')->count(),
            'empty' => Category::doesntHave('products')->count(),
            'total_products' => Product::count(),
        ];
        return view('admin.categories.index', compact('categories', 'stats'));
    }

    public function categoryCreate()
    {
        return view('admin.categories.create');
    }

    public function categoryStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('category_icons', 'public');
        }

        Category::create($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function categoryEdit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function categoryUpdate(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('category_icons', 'public');
        }

        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function categoryDestroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category with existing products');
        }
        
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }

    // Reports
    public function reports()
    {
        // Total revenue and orders
        $totalRevenue = ProductOrder::sum('total_price');
        $totalOrders = ProductOrder::count();
        
        // Monthly revenue
        $monthlyRevenue = ProductOrder::selectRaw('MONTH(created_at) as month, SUM(total_price) as revenue')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top sellers
        $topSellers = User::where('role', 'pelaku_umkm')
            ->withCount(['products', 'orders'])
            ->orderBy('orders_count', 'desc')
            ->take(10)
            ->get();

        // Top products
        $topProducts = Product::withCount('orders')
            ->withSum('orders', 'total_price')
            ->orderBy('orders_count', 'desc')
            ->take(10)
            ->get();

        // Recent orders
        $recentOrders = ProductOrder::with(['product', 'pembeli'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.reports.index', compact(
            'totalRevenue', 
            'totalOrders', 
            'monthlyRevenue', 
            'topSellers', 
            'topProducts',
            'recentOrders'
        ));
    }

    // Analytics
    public function analytics()
    {
        // User growth
        $userGrowth = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Order trends
        $orderTrends = ProductOrder::selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(total_price) as revenue')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Category performance
        $categoryPerformance = Category::withCount('products')
            ->withSum('products', 'price')
            ->orderBy('products_count', 'desc')
            ->get();

        return view('admin.analytics.index', compact('userGrowth', 'orderTrends', 'categoryPerformance'));
    }

    // System Settings
    public function settings()
    {
        return view('admin.settings.index');
    }

    public function settingsUpdate(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'min_withdrawal' => 'required|numeric|min:0',
            'max_products_per_user' => 'required|integer|min:1'
        ]);

        // Update settings in database or config
        foreach ($validated as $key => $value) {
            // You can store settings in a settings table or use config files
            // For now, we'll just return success
        }

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
    }
}
