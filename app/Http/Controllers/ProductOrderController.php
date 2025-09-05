<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // 1 table di pake 2 fitur yaitu my orders dan transaction
    public function index()
    {
        // Cek role untuk menentukan data yang ditampilkan
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            // Admin melihat semua orders
            $my_orders = ProductOrder::with(['product', 'pembeli', 'creator'])->get();
            return view('admin.product_orders.index', compact('my_orders'));
        } elseif ($user->role === 'pelaku_umkm') {
            // Pelaku UMKM melihat orders untuk produknya
            $my_orders = ProductOrder::where('creator_id', Auth::id())->with(['product', 'pembeli'])->get();
            return view('pelaku_umkm.orders.index', compact('my_orders'));
        } else {
            // pembeli melihat orders yang dia beli
            $my_orders = ProductOrder::where('pembeli_id', Auth::id())->with(['product', 'creator'])->get();
            return view('pembeli.purchases', compact('my_orders'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductOrder $productOrder)
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return view('admin.product_orders.details', compact('productOrder'));
        } elseif ($user->role === 'pelaku_umkm') {
            return view('pelaku_umkm.orders.details', compact('productOrder'));
        } else {
            return view('pembeli.purchase-details', compact('productOrder'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductOrder $productOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductOrder $productOrder)
    {
        $productOrder->update(['is_paid' => true]);
        return redirect()->back()->with('message', 'Order sucess updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductOrder $productOrder)
    {
        //
    }

    public function transactions()
    {
        // utk kita melihat product yg kita beli dari org lain
        $my_transactions = ProductOrder::where('pembeli_id', Auth::id())->get(); // cari data berdasarkan creator id
        
        $user = Auth::user();
        if ($user->role === 'admin') {
            return view('admin.product_orders.transactions', compact('my_transactions'));
        } elseif ($user->role === 'pelaku_umkm') {
            return view('pelaku_umkm.transactions', compact('my_transactions'));
        } else {
            return view('pembeli.purchases', compact('my_transactions'));
        }
    }


    public function transactions_details(ProductOrder $productOrder)
    {
        // dd($productOrder);
        return view('admin.product_orders.transaction_details', [
            'order' => $productOrder,
        ]);
    }

    public function download_file(ProductOrder $productOrder)
    {
        $user_id = Auth::id();
        $product_id = $productOrder->product_id;

        $paidTransactionExits = ProductOrder::where('pembeli_id', $user_id)
            ->where('product_id', $product_id)
            ->where('is_paid', 1)->first();
        if (!$paidTransactionExits) {
            session()->flash('error', 'you must purchase before download');
            return redirect()->back();
        }

        $productDetails = Product::find($product_id);
        // dd($productDetails->about);
        $filePath = $productDetails->path_file;

        if (!Storage::disk('public')->exists($filePath)) {
            return abort(404);
        }

        return Storage::disk('public')->download($filePath);
    }
}
