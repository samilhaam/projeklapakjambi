<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function checkout(Product $product)
    {
        return view('front.checkout', [
            'product' => $product,
        ]);
    }

    public function store(Request $request, Product $product)
    {
        // jika creator beli productnya sendiri maka kita cegat
        if ($product->creator_id === Auth::id()) {
            $error = ValidationException::withMessages([
                'system_error' => ['Do not buy you own product !!']
            ]);
            throw $error;
        }

        $validated = $request->validate([
            'proof' => 'required|mimes:png,jpg,jpeg|max:2046'
        ]);

        if ($request->hasFile('proof')) {
            $proofPath = $request->file('proof')->store('payment_proofs', 'public');
            $validated['proof'] = $proofPath;
        }

        $data = [
            'total_price' => $product->price,
            'is_paid' => false,
            'pembeli_id' => Auth::id(),
            'creator_id' => $product->creator_id,
            'product_id' => $product->id,
            'proof' => $validated['proof'],
        ];
        DB::beginTransaction();

        try {
            $newOrder = ProductOrder::firstOrCreate($data);
            DB::commit();
            
            // Redirect berdasarkan role user
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.product_orders.transaction')->with('success', 'Transaction Created SuccessFuly');
            } elseif ($user->role === 'pelaku_umkm') {
                return redirect()->route('pelaku_umkm.transactions')->with('success', 'Transaction Created SuccessFuly');
            } else {
                return redirect()->route('pembeli.purchases')->with('success', 'Transaction Created SuccessFuly');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System_Error' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
