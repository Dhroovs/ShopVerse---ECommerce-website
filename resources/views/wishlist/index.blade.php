@extends('layouts.app')
@section('title', 'My Wishlist')
@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4"><i class="fas fa-heart me-2 text-danger"></i>My Wishlist</h2>
    @if($wishlistItems->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-heart fa-4x text-muted mb-4"></i>
            <h4 class="text-muted">Your wishlist is empty</h4>
            <p class="text-muted mb-4">Save products you love to come back to them later!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-5">Browse Products</a>
        </div>
    @else
    <div class="row g-4">
        @foreach($wishlistItems as $item)
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card product-card shadow-sm h-100">
                <a href="{{ route('products.show', $item->product->slug) }}">
                    <img src="{{ $item->product->image ?? 'https://via.placeholder.com/400x300/6366f1/FFFFFF?text=Product' }}"
                         class="card-img-top" alt="{{ $item->product->name }}" style="height:200px;object-fit:cover;">
                </a>
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title fw-semibold">
                        <a href="{{ route('products.show', $item->product->slug) }}" class="text-dark text-decoration-none">{{ $item->product->name }}</a>
                    </h6>
                    <div class="mb-3 mt-auto">
                        @if($item->product->sale_price)
                            <span class="fw-bold text-danger fs-5">${{ number_format($item->product->sale_price, 2) }}</span>
                            <small class="text-muted text-decoration-line-through ms-1">${{ number_format($item->product->price, 2) }}</small>
                        @else
                            <span class="fw-bold text-dark fs-5">${{ number_format($item->product->price, 2) }}</span>
                        @endif
                    </div>
                    <div class="d-flex gap-2">
                        <form method="POST" action="{{ route('cart.add') }}" class="flex-grow-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-cart-plus me-1"></i>Add to Cart
                            </button>
                        </form>
                        <form method="POST" action="{{ route('wishlist.toggle') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Remove from wishlist">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
