@extends('layouts.app')
@section('title', 'My Orders')
@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="fas fa-box me-2 text-primary"></i>My Orders</h2>
    @if($orders->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-4x text-muted mb-4"></i>
            <h4 class="text-muted">No orders yet</h4>
            <p class="text-muted mb-4">Start shopping to see your orders here!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">Shop Now</a>
        </div>
    @else
    <div class="card border-0 shadow-sm rounded-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Order #</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>{{ $order->orderItems->count() ?? '-' }} items</td>
                        <td class="fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                        <td>
                            <span class="badge status-{{ $order->status }} px-3 py-2">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">{{ $orders->links() }}</div>
    @endif
</div>
@endsection
