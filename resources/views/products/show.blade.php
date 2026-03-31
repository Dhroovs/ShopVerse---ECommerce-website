@extends('layouts.app')
@section('title', $product->name)
@section('content')
<div class="container my-5">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category_id]) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>
    <div class="row g-5">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <img src="{{ $product->image ?? 'https://via.placeholder.com/600x500/6366f1/FFFFFF?text=Product' }}"
                     class="img-fluid" alt="{{ $product->name }}" style="max-height: 450px; object-fit: cover; width: 100%;">
            </div>
        </div>
        <div class="col-md-7">
            <span class="badge bg-primary badge-category mb-2">{{ $product->category->name }}</span>
            <h1 class="fw-bold mb-3">{{ $product->name }}</h1>
            <div class="mb-4">
                @if($product->sale_price)
                    <span class="display-6 fw-bold text-danger">${{ number_format($product->sale_price, 2) }}</span>
                    <span class="text-muted text-decoration-line-through ms-2 fs-5">${{ number_format($product->price, 2) }}</span>
                    <span class="badge bg-danger ms-2">
                        {{ round((1 - $product->sale_price / $product->price) * 100) }}% OFF
                    </span>
                @else
                    <span class="display-6 fw-bold text-dark">${{ number_format($product->price, 2) }}</span>
                @endif
            </div>
            <div class="mb-3">
                @if($product->stock > 0)
                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>In Stock ({{ $product->stock }} available)</span>
                @else
                    <span class="badge bg-danger">Out of Stock</span>
                @endif
            </div>
            <p class="text-muted mb-4">{{ $product->description }}</p>
            @auth
            @if($product->stock > 0)
            <form method="POST" action="{{ route('cart.add') }}" class="mb-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <label class="fw-semibold">Quantity:</label>
                    <div class="input-group" style="width: 130px;">
                        <button type="button" class="btn btn-outline-secondary" onclick="changeQty(-1)">-</button>
                        <input type="number" name="quantity" id="qty" class="form-control text-center" value="1" min="1" max="{{ $product->stock }}">
                        <button type="button" class="btn btn-outline-secondary" onclick="changeQty(1)">+</button>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg px-5 me-3">
                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                </button>
            </form>
            @endif
            <form method="POST" action="{{ route('wishlist.toggle') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-outline-danger">
                    <i class="fas fa-heart me-2"></i>Add to Wishlist
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">
                <i class="fas fa-sign-in-alt me-2"></i>Login to Buy
            </a>
            @endauth
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
function changeQty(delta) {
    var input = document.getElementById('qty');
    var val = parseInt(input.value) + delta;
    var max = parseInt(input.max);
    if (val >= 1 && val <= max) input.value = val;
}
</script>
@endsection
