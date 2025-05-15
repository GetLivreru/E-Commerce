<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Basket;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $basket = Basket::where('user_id', Auth::id())->with('products')->first();
        if (!$basket || $basket->products->isEmpty()) {
            return response()->json(['message' => 'Basket is empty'], 400);
        }
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'new',
        ]);
        foreach ($basket->products as $product) {
            $order->products()->attach($product->id, ['quantity' => $product->pivot->quantity]);
        }
        $basket->products()->detach();
        return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('products')->get();
        return response()->json($orders);
    }
} 