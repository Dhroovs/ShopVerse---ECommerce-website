<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $cartItems->sum(fn($item) => $item->product->getCurrentPrice() * $item->quantity);
        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity ?? 1;

        $cartItem = Cart::where('user_id', auth()->id())->where('product_id', $product->id)->first();
        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
        } else {
            Cart::create(['user_id' => auth()->id(), 'product_id' => $product->id, 'quantity' => $quantity]);
        }
        return back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cartItem = Cart::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $cartItem->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        Cart::where('id', $id)->where('user_id', auth()->id())->delete();
        return back()->with('success', 'Item removed from cart!');
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();
        return back()->with('success', 'Cart cleared!');
    }
}
