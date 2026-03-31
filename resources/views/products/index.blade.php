@extends('layouts.app')
@section('title', 'Products')
@section('content')
<div class="container my-5">
    <div class="row g-4">
        <!-- Sidebar Filters -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Search & Filter</h5>
                    <form method="GET" action="{{ route('products.index') }}">
                        <div class="mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-muted small text-uppercase">Categories</label>
                            <div class="d-flex flex-column gap-2">
                                <a href="{{ route('products.index', array_merge(request()->except('category', 'page'), [])) }}"
                                   class="btn btn-sm {{ !request('category') ? 'btn-primary' : 'btn-outline-secondary' }} text-start">
                                    All Categories
                                </a>
                                @foreach($categories as $category)
                                <a href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $category->id])) }}"
                                   class="btn btn-sm {{ request('category') == $category->id ? 'btn-primary' : 'btn-outline-secondary' }} text-start">
                                    {{ $category->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i>Search</button>
                        @if(request('search') || request('category'))
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">Clear Filters</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0">
                    Products
                    @if(request('search')) <small class="text-muted fs-6">for "{{ request('search') }}"</small> @endif
                </h4>
                <span class="text-muted">{{ $products->total() }} items</span>
            </div>
            @if($products->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No products found</h5>
                    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">View All Products</a>
                </div>
            @else
            <div class="row g-4">
                @foreach($products as $product)
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card product-card shadow-sm h-100">
                        <a href="{{ route('products.show', $product->slug) }}" class="position-relative">
                            <img src="{{ $product->image ?? 'https://via.placeholder.com/400x300/6366f1/FFFFFF?text=Product' }}"
                                 class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            @if($product->sale_price)
                                <span class="position-absolute top-0 end-0 m-2 badge bg-danger">Sale</span>
                            @endif
                        </a>
                        <div class="card-body d-flex flex-column">
                            <span class="badge bg-primary badge-category mb-2 align-self-start">{{ $product->category->name }}</span>
                            <h6 class="card-title fw-semibold">
                                <a href="{{ route('products.show', $product->slug) }}" class="text-dark text-decoration-none">{{ $product->name }}</a>
                            </h6>
                            <p class="card-text text-muted small flex-grow-1">{{ Str::limit($product->description, 80) }}</p>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div>
                                    @if($product->sale_price)
                                        <span class="fw-bold text-danger fs-5">${{ number_format($product->sale_price, 2) }}</span>
                                        <small class="text-muted text-decoration-line-through ms-1">${{ number_format($product->price, 2) }}</small>
                                    @else
                                        <span class="fw-bold text-dark fs-5">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <small class="text-muted">{{ $product->stock }} left</small>
                            </div>
                            <div class="d-flex gap-2">
                                @auth
                                <form method="POST" action="{{ route('cart.add') }}" class="flex-grow-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                        <i class="fas fa-cart-plus me-1"></i>Add to Cart
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('wishlist.toggle') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                                @else
                                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login to Buy
                                </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
