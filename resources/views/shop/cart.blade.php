@extends('layouts.app')

@section('title', 'Your Cart - MyStore')

@section('content')

@php
    $cart = session('cart', []);
@endphp

<div class="row">
    <div class="col-lg-8">
        <h2 class="mb-4">Your Cart</h2>

        @if(count($cart) > 0)
            <form method="POST" action="/cart/update" id="cartForm">
                @csrf
                
                <div class="table-responsive">
                    <table class="table table-bordered bg-white shadow-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th width="120">Quantity</th>
                                <th>Total</th>
                                <th width="50"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            
                            @foreach($cart as $id => $item)
                                @php
                                    $total = $item['price'] * $item['qty'];
                                    $grandTotal += $total;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://picsum.photos/60/60?random={{ $id }}" 
                                                 width="50" 
                                                 height="50" 
                                                 style="object-fit: cover; border-radius: 8px;">
                                            <div>
                                                <strong>{{ $item['name'] }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>₹{{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <input type="number" 
                                               name="qty[{{ $id }}]" 
                                               value="{{ $item['qty'] }}" 
                                               min="1" 
                                               class="form-control form-control-sm">
                                    </td>
                                    <td class="fw-bold">₹{{ number_format($total, 2) }}</td>
                                    <td class="text-center">
                                        <form method="POST" action="/cart/remove/{{ $id }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                ✕
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a href="/" class="btn btn-outline-secondary">
                        ← Continue Shopping
                    </a>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-dark">
                            Update Cart
                        </button>
                        <a href="/checkout" class="btn btn-success">
                            Proceed to Checkout →
                        </a>
                    </div>
                </div>
            </form>
        @else
            <div class="card text-center p-5">
                <h4>Your cart is empty 🛒</h4>
                <a href="/" class="btn btn-primary mt-2">Start Shopping</a>
            </div>
        @endif
    </div>

    @if(count($cart) > 0)
    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Order Summary</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal:</span>
                    <span>₹{{ number_format($grandTotal, 2) }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Shipping:</span>
                    <span class="text-success">Free</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <strong>Total:</strong>
                    <strong class="text-primary fs-5">₹{{ number_format($grandTotal, 2) }}</strong>
                </div>
                <a href="/checkout" class="btn btn-success w-100">
                    Checkout Now
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection