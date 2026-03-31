<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    // Add to Cart
    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                "product_id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "qty" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Show Cart
    public function index()
    {
        return view('shop.cart');
    }

    // Remove Item
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    // Update Quantity
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->qty as $id => $qty) {
            if (isset($cart[$id])) {
                $cart[$id]['qty'] = $qty;
            }
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }
}