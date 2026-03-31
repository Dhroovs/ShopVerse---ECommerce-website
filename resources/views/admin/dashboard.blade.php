@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-lg-2 mb-4">
            <div class="sidebar-admin rounded-3 p-3">
                <h6 class="text-white fw-bold mb-3 px-2"><i class="fas fa-tachometer-alt me-2"></i>Admin Panel</h6>
                <nav class="nav flex-column">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                        <i class="fas fa-home me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                        <i class="fas fa-box me-2"></i>Products
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link">
                        <i class="fas fa-shopping-bag me-2"></i>Orders
                    </a>
                    <hr class="border-secondary">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="fas fa-store me-2"></i>View Store
                    </a>
                </nav>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-lg-10">
            <h3 class="fw-bold mb-4">Dashboard Overview</h3>
            <!-- Stats Cards -->
            <div class="row g-4 mb-5">
                <div class="col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body d-flex align-items-center p-4">
                            <div class="flex-grow-1">
                                <small class="text-muted text-uppercase fw-semibold">Total Users</small>
                                <h2 class="fw-bold mb-0 text-primary">{{ $totalUsers }}</h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-users fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body d-flex align-items-center p-4">
                            <div class="flex-grow-1">
                                <small class="text-muted text-uppercase fw-semibold">Total Products</small>
                                <h2 class="fw-bold mb-0 text-success">{{ $totalProducts }}</h2>
                            </div>
                            <div class="bg-success bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-box fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body d-flex align-items-center p-4">
                            <div class="flex-grow-1">
                                <small class="text-muted text-uppercase fw-semibold">Total Orders</small>
                                <h2 class="fw-bold mb-0 text-warning">{{ $totalOrders }}</h2>
                            </div>
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-shopping-bag fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body d-flex align-items-center p-4">
                            <div class="flex-grow-1">
                                <small class="text-muted text-uppercase fw-semibold">Total Revenue</small>
                                <h2 class="fw-bold mb-0 text-danger">${{ number_format($totalRevenue, 0) }}</h2>
                            </div>
                            <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                                <i class="fas fa-dollar-sign fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Recent Orders -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent Orders</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Order #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="fw-bold">${{ number_format($order->total_amount, 2) }}</td>
                                <td><span class="badge status-{{ $order->status }} px-3 py-2">{{ ucfirst($order->status) }}</span></td>
                                <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a></td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center py-4 text-muted">No orders yet</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
