<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    // Show Checkout Page
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('shop.checkout', compact('cart'));
    }

    // Place Order
    public function placeOrder(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'phone'   => 'required',
            'address' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (count($cart) == 0) {
            return redirect('/cart');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'name'    => $request->name,
            'phone'   => $request->phone,
            'address' => $request->address,
            'total'   => $total,
            'status'  => 'pending',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'  => $order->id,
                'product_id'=> $item['product_id'],
                'quantity'  => $item['qty'],
                'price'     => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect('/')->with('success', 'Order placed successfully!');
    }
}