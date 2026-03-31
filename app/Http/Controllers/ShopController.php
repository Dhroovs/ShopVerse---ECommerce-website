<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home(Request $request)
    {
        $query = Product::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(8);

        return view('shop.home', compact('products'));
        
    }
    public function show($id)
{
    $product = \App\Models\Product::findOrFail($id);
    return view('shop.product', compact('product'));
}
}