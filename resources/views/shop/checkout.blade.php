@extends('layouts.app')

@section('title', 'Checkout - MyStore')

@section('content')

<div class="row">
    <div class="col-lg-7">
        <h2 class="mb-4">Checkout</h2>

        @if(count($cart) > 0)
        <form method="POST" action="/order/place" id="checkoutForm">
            @csrf
            
            <div class="card shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="mb-3">Customer Details</h5>
                    
                    <div class="mb-3">
                        <label class="form-label">Full Name *</label>
                        <input type="text" 
                               name="name" 
                               class="form-control" 
                               placeholder="Enter your full name" 
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Phone Number *</label>
                        <input type="tel" 
                               name="phone" 
                               class="form-control" 
                               placeholder="Enter your phone number" 
                               required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        @auth
                            <input type="email" 
                                   name="email" 
                                   class="form-control" 
                                   value="{{ Auth::user()->email }}"
                                   placeholder="your@email.com">
                        @else
                            <input type="email" 
                                   name="email" 
                                   class="form-control" 
                                   placeholder="your@email.com">
                        @endauth
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Delivery Address *</label>
                        <textarea name="address" 
                                  class="form-control" 
                                  rows="3" 
                                  placeholder="House No, Street, City, Pincode" 
                                  required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Order Notes (Optional)</label>
                        <textarea name="notes" 
                                  class="form-control" 
                                  rows="2" 
                                  placeholder="Any special instructions?"></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Payment Method (Simple) -->
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-3">Payment Method</h5>
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                        <label class="form-check-label" for="cod">
                            <i class="fas fa-money-bill-wave me-2"></i>Cash on Delivery
                        </label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="online" value="online" disabled>
                        <label class="form-check-label text-muted" for="online">
                            <i class="fas fa-credit-card me-2"></i>Online Payment (Coming Soon)
                        </label>
                    </div>
                </div>
            </div>
        </form>
        @else
            <div class="alert alert-warning">Your cart is empty. <a href="/">Continue Shopping</a></div>
        @endif
    </div>
    
    <!-- Order Summary Sidebar -->
    @if(count($cart) > 0)
    <div class="col-lg-5">
        <div class="card shadow-sm sticky-top" style="top: 100px;">
            <div class="card-header bg-white">
                <h5 class="mb-0">Order Summary</h5>
            </div>
            <div class="card-body">
                @php $total = 0; @endphp
                
                @foreach($cart as $item)
                    @php
                        $itemTotal = $item['price'] * $item['qty'];
                        $total += $itemTotal;
                    @endphp
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>
                            {{ $item['name'] }} 
                            <span class="text-muted">x{{ $item['qty'] }}</span>
                        </span>
                        <span>₹{{ number_format($itemTotal, 2) }}</span>
                    </div>
                @endforeach
                
                <hr>
                
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal:</span>
                    <span>₹{{ number_format($total, 2) }}</span>
                </div>
                
                <div class="d-flex justify-content-between mb-2">
                    <span>Shipping:</span>
                    <span class="text-success">Free</span>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between mb-3">
                    <strong class="fs-5">Total:</strong>
                    <strong class="fs-5 text-primary">₹{{ number_format($total, 2) }}</strong>
                </div>
                
                <button type="submit" form="checkoutForm" class="btn btn-success w-100 btn-lg">
                    <i class="fas fa-check-circle me-2"></i>Place Order
                </button>
                
                <div class="text-center mt-3">
                    <small class="text-muted">
                        <i class="fas fa-lock me-1"></i> Secure checkout
                    </small>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@push('styles')
<style>
    .sticky-top {
        position: sticky;
    }
    
    .card {
        border-radius: 16px;
        border: none;
    }
    
    .card-header {
        border-bottom: 1px solid #e5e7eb;
        background: white;
        border-radius: 16px 16px 0 0 !important;
    }
    
    body.dark-mode .card-header {
        background: #2d2d3a;
        border-bottom-color: #3f3f4e;
    }
    
    .form-control:focus, textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    @media (max-width: 768px) {
        .sticky-top {
            position: relative;
            top: 0;
            margin-top: 20px;
        }
    }
</style>
@endpush