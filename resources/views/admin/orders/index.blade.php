@extends('layouts.app')
@section('title', 'Admin - Orders')
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
            <h3 class="fw-bold mb-4">All Orders</h3>
            <div class="card border-0 shadow-sm rounded-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Order #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                                <td>
                                    <div>{{ $order->user->name }}</div>
                                    <small class="text-muted">{{ $order->user->email }}</small>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                                <td><span class="badge bg-secondary text-uppercase">{{ $order->payment_method }}</span></td>
                                <td><span class="badge status-{{ $order->status }} px-3 py-2">{{ ucfirst($order->status) }}</span></td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted">No orders yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
