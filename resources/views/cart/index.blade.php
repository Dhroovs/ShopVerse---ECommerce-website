@extends('layouts.app')
@section('title', 'My Cart')
@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="fas fa-shopping-cart me-2 text-primary"></i>My Cart</h2>
    @if($cartItems->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
            <h4 class="text-muted">Your cart is empty</h4>
            <p class="text-muted mb-4">Add some products to get started!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-shopping-bag me-2"></i>Start Shopping
            </a>
        </div>
    @else
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->product->image ?? 'https://via.placeholder.com/60x60/6366f1/FFFFFF?text=P' }}"
                                                 alt="{{ $item->product->name }}" class="rounded me-3" style="width:60px;height:60px;object-fit:cover;">
                                            <div>
                                                <h6 class="mb-0 fw-semibold">{{ $item->product->name }}</h6>
                                                <small class="text-muted">{{ $item->product->category->name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>${{ number_format($item->product->getCurrentPrice(), 2) }}</td>
                                    <td style="width:150px;">
                                        <form method="POST" action="{{ route('cart.update', $item->id) }}">
                                            @csrf @method('PATCH')
                                            <div class="input-group input-group-sm">
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width:70px;">
                                                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-sync-alt"></i></button>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="fw-bold">${{ number_format($item->product->getCurrentPrice() * $item->quantity, 2) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Remove this item?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light d-flex justify-content-between">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-1"></i>Continue Shopping
                    </a>
                    <form method="POST" action="{{ route('cart.clear') }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Clear entire cart?')">
                            <i class="fas fa-trash me-1"></i>Clear Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-4">Order Summary</h5>
                    @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between small mb-2">
                        <span class="text-muted">{{ $item->product->name }} x{{ $item->quantity }}</span>
                        <span>${{ number_format($item->product->getCurrentPrice() * $item->quantity, 2) }}</span>
                    </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                        <span>Total</span>
                        <span class="text-primary">${{ number_format($total, 2) }}</span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="btn btn-primary w-100 btn-lg">
                        <i class="fas fa-lock me-2"></i>Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
