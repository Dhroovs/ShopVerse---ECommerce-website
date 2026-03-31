@extends('layouts.app')
@section('title', 'Admin - Products')
@section('content')
<div class="container-fluid my-4">
    <div class="row">
        <div class="col-lg-2 mb-4">
            <div class="sidebar-admin rounded-3 p-3">
                <h6 class="text-white fw-bold mb-3 px-2"><i class="fas fa-tachometer-alt me-2"></i>Admin Panel</h6>
                <nav class="nav flex-column">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-home me-2"></i>Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="nav-link active"><i class="fas fa-box me-2"></i>Products</a>
                    <a href="{{ route('admin.orders.index') }}" class="nav-link"><i class="fas fa-shopping-bag me-2"></i>Orders</a>
                    <hr class="border-secondary">
                    <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-store me-2"></i>View Store</a>
                </nav>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold mb-0">Products</h3>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Product
                </a>
            </div>
            <div class="card border-0 shadow-sm rounded-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ $product->image ?? 'https://via.placeholder.com/50x50/6366f1/FFFFFF?text=P' }}"
                                         alt="{{ $product->name }}" class="rounded" style="width:50px;height:50px;object-fit:cover;">
                                </td>
                                <td class="fw-semibold">{{ $product->name }}</td>
                                <td><span class="badge bg-primary">{{ $product->category->name }}</span></td>
                                <td>
                                    @if($product->sale_price)
                                        <span class="text-danger fw-bold">${{ number_format($product->sale_price, 2) }}</span>
                                        <small class="text-muted text-decoration-line-through">${{ number_format($product->price, 2) }}</small>
                                    @else
                                        ${{ number_format($product->price, 2) }}
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td>
                                    @if($product->featured)
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="fas fa-star text-muted"></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Delete this product?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center py-4 text-muted">No products found</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white">{{ $products->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
