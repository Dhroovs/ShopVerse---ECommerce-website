@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="fas fa-lock me-2 text-primary"></i>Checkout</h2>
    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Shipping Info -->
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4"><i class="fas fa-truck me-2 text-primary"></i>Shipping Information</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name *</label>
                                <input type="text" name="shipping_name" class="form-control @error('shipping_name') is-invalid @enderror"
                                       value="{{ old('shipping_name', auth()->user()->name) }}" required>
                                @error('shipping_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email *</label>
                                <input type="email" name="shipping_email" class="form-control @error('shipping_email') is-invalid @enderror"
                                       value="{{ old('shipping_email', auth()->user()->email) }}" required>
                                @error('shipping_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Phone *</label>
                                <input type="text" name="shipping_phone" class="form-control @error('shipping_phone') is-invalid @enderror"
                                       value="{{ old('shipping_phone', auth()->user()->phone) }}" required>
                                @error('shipping_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Street Address *</label>
                                <input type="text" name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror"
                                       value="{{ old('shipping_address', auth()->user()->address) }}" required>
                                @error('shipping_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">City *</label>
                                <input type="text" name="shipping_city" class="form-control @error('shipping_city') is-invalid @enderror"
                                       value="{{ old('shipping_city') }}" required>
                                @error('shipping_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">State *</label>
                                <input type="text" name="shipping_state" class="form-control @error('shipping_state') is-invalid @enderror"
                                       value="{{ old('shipping_state') }}" required>
                                @error('shipping_state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">ZIP Code *</label>
                                <input type="text" name="shipping_zip" class="form-control @error('shipping_zip') is-invalid @enderror"
                                       value="{{ old('shipping_zip') }}" required>
                                @error('shipping_zip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Order Notes (Optional)</label>
                                <textarea name="notes" class="form-control" rows="3" placeholder="Any special instructions...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Payment Method -->
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4"><i class="fas fa-credit-card me-2 text-primary"></i>Payment Method</h5>
                        <div class="form-check p-3 border rounded-3 bg-light">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                            <label class="form-check-label fw-semibold" for="cod">
                                <i class="fas fa-money-bill-wave me-2 text-success"></i>Cash on Delivery
                                <small class="d-block text-muted">Pay when your order arrives</small>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Order Summary</h5>
                        @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex align-items-center">
                                <img src="{{ $item->product->image ?? 'https://via.placeholder.com/40x40/6366f1/FFFFFF?text=P' }}"
                                     alt="" class="rounded me-2" style="width:40px;height:40px;object-fit:cover;">
                                <div>
                                    <small class="fw-semibold">{{ Str::limit($item->product->name, 25) }}</small>
                                    <small class="d-block text-muted">x{{ $item->quantity }}</small>
                                </div>
                            </div>
                            <small class="fw-bold">${{ number_format($item->product->getCurrentPrice() * $item->quantity, 2) }}</small>
                        </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between text-muted mb-1">
                            <span>Subtotal</span><span>${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted mb-1">
                            <span>Shipping</span><span class="text-success">Free</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                            <span>Total</span>
                            <span class="text-primary">${{ number_format($total, 2) }}</span>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            <i class="fas fa-check-circle me-2"></i>Place Order
                        </button>
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                            <i class="fas fa-arrow-left me-1"></i>Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
