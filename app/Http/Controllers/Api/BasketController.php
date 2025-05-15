<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Basket;

class BasketController extends Controller
{
    public function index()
    {
        $basket = Basket::where('user_id', Auth::id())->with('products')->first();
        return response()->json($basket);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);
        $basket = Basket::firstOrCreate(['user_id' => Auth::id()]);
        $basket->products()->syncWithoutDetaching([
            $request->product_id => ['quantity' => $request->input('quantity', 1)]
        ]);
        return response()->json(['message' => 'Product added to basket']);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $basket = Basket::where('user_id', Auth::id())->first();
        if ($basket) {
            $basket->products()->detach($request->product_id);
        }
        return response()->json(['message' => 'Product removed from basket']);
    }
} 