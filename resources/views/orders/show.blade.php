@extends('layouts.app')
@section('title', 'Order #' . $order->id)
@section('content')
<div class="container my-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1">Order #{{ $order->id }}</h2>
            <p class="text-muted mb-0">Placed on {{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
        </div>
        <span class="badge status-{{ $order->status }} px-4 py-2 fs-6">{{ ucfirst($order->status) }}</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <!-- Order Items -->
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0"><i class="fas fa-list me-2 text-primary"></i>Order Items</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->product->image ?? 'https://via.placeholder.com/50x50/6366f1/FFFFFF?text=P' }}"
                                             alt="{{ $item->product->name }}" class="rounded me-3" style="width:50px;height:50px;object-fit:cover;">
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $item->product->name }}</h6>
                                            <small class="text-muted">{{ $item->product->category->name }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="fw-bold">${{ number_format($item->price * $item->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold pe-3">Total:</td>
                                <td class="fw-bold text-primary fs-5">${{ number_format($order->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Shipping Info -->
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="fas fa-truck me-2 text-primary"></i>Shipping Info</h5>
                    <p class="mb-1 fw-semibold">{{ $order->shipping_name }}</p>
                    <p class="mb-1 text-muted"><i class="fas fa-envelope me-1"></i>{{ $order->shipping_email }}</p>
                    <p class="mb-1 text-muted"><i class="fas fa-phone me-1"></i>{{ $order->shipping_phone }}</p>
                    <p class="mb-1 text-muted"><i class="fas fa-map-marker-alt me-1"></i>{{ $order->shipping_address }}</p>
                    <p class="mb-0 text-muted">{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
                    @if($order->notes)
                    <hr>
                    <p class="mb-0 text-muted"><i class="fas fa-sticky-note me-1"></i>{{ $order->notes }}</p>
                    @endif
                </div>
            </div>
            <!-- Payment Info -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-3"><i class="fas fa-credit-card me-2 text-primary"></i>Payment</h5>
                    <p class="mb-1"><span class="text-muted">Method:</span> <strong>{{ strtoupper($order->payment_method) }}</strong></p>
                    <p class="mb-0"><span class="text-muted">Amount:</span> <strong class="text-primary">${{ number_format($order->total_amount, 2) }}</strong></p>
                </div>
            </div>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary w-100 mt-3">
                <i class="fas fa-arrow-left me-1"></i>Back to Orders
            </a>
        </div>
    </div>
</div>
@endsection
