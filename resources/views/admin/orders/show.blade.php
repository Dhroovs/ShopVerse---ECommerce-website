@extends('layouts.app')
@section('title', 'Admin - Order #' . $order->id)
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <div class="col-lg-2 mb-4">
            <div class="sidebar-admin rounded-3 p-3">
                <h6 class="text-white fw-bold mb-3 px-2"><i class="fas fa-tachometer-alt me-2"></i>Admin Panel</h6>
                <nav class="nav flex-column">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-home me-2"></i>Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link"><i class="fas fa-box me-2"></i>Products</a>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link active"><i class="fas fa-shopping-bag me-2"></i>Orders</a>
                    <hr class="border-secondary">
                    <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-store me-2"></i>View Store</a>
                </nav>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h3 class="fw-bold mb-1">Order #{{ $order->id }}</h3>
                    <p class="text-muted mb-0">{{ $order->created_at->format('F d, Y \a\t g:i A') }}</p>
                </div>
                <span class="badge status-{{ $order->status }} px-4 py-2 fs-6 ms-auto">{{ ucfirst($order->status) }}</span>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Update Status -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3"><i class="fas fa-edit me-2 text-primary"></i>Update Status</h5>
                            <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="d-flex gap-3 align-items-end">
                                @csrf @method('PATCH')
                                <div class="flex-grow-1">
                                    <label class="form-label fw-semibold">Order Status</label>
                                    <select name="status" class="form-select">
                                        @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Update
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Order Items -->
                    <div class="card border-0 shadow-sm rounded-3">
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
                                                <h6 class="mb-0 fw-semibold">{{ $item->product->name }}</h6>
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
                    <!-- Customer Info -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3"><i class="fas fa-user me-2 text-primary"></i>Customer</h5>
                            <p class="mb-1 fw-semibold">{{ $order->user->name }}</p>
                            <p class="mb-0 text-muted">{{ $order->user->email }}</p>
                        </div>
                    </div>
                    <!-- Shipping Info -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3"><i class="fas fa-truck me-2 text-primary"></i>Shipping</h5>
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
                    <!-- Payment -->
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3"><i class="fas fa-credit-card me-2 text-primary"></i>Payment</h5>
                            <p class="mb-1"><span class="text-muted">Method:</span> <strong>{{ strtoupper($order->payment_method) }}</strong></p>
                            <p class="mb-0"><span class="text-muted">Total:</span> <strong class="text-primary">${{ number_format($order->total_amount, 2) }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
