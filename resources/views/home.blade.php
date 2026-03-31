@extends('layouts.app')
@section('title', 'Home')
@section('content')

<!-- Hero Carousel -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="hero-section d-flex align-items-center text-white">
                <div class="container text-center py-5">
                    <h1 class="display-4 fw-bold mb-3">🛍️ Welcome to ShopVerse</h1>
                    <p class="lead mb-4">Discover thousands of products at amazing prices</p>
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-5 fw-semibold">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex align-items-center text-white" style="background: linear-gradient(135deg, #f59e0b, #ef4444); min-height: 500px;">
                <div class="container text-center py-5">
                    <h1 class="display-4 fw-bold mb-3">🔥 Hot Deals & Discounts</h1>
                    <p class="lead mb-4">Save up to 40% on selected products</p>
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-5 fw-semibold">View Deals</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex align-items-center text-white" style="background: linear-gradient(135deg, #10b981, #3b82f6); min-height: 500px;">
                <div class="container text-center py-5">
                    <h1 class="display-4 fw-bold mb-3">🚚 Free Shipping Available</h1>
                    <p class="lead mb-4">On all orders above $50 – shop more, save more!</p>
                    <a href="{{ route('products.index') }}" class="btn btn-light btn-lg px-5 fw-semibold">Start Shopping</a>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Categories -->
<div class="container my-5">
    <h2 class="fw-bold mb-4 text-center">Shop by Category</h2>
    <div class="row g-3 justify-content-center">
        @foreach($categories as $category)
        <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-decoration-none">
                <div class="card text-center border-0 shadow-sm rounded-3 p-3 h-100" style="transition: transform .2s;" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div class="fs-2 mb-2">
                        @if($category->slug === 'electronics') 📱
                        @elseif($category->slug === 'clothing') 👕
                        @elseif($category->slug === 'books') 📚
                        @elseif($category->slug === 'home-garden') 🏡
                        @elseif($category->slug === 'sports') ⚽
                        @else 🛍️
                        @endif
                    </div>
                    <h6 class="fw-semibold mb-1 text-dark">{{ $category->name }}</h6>
                    <small class="text-muted">{{ $category->products_count }} items</small>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<!-- Featured Products -->
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Featured Products</h2>
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">View All <i class="fas fa-arrow-right ms-1"></i></a>
    </div>
    @if($featuredProducts->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="fas fa-box-open fa-3x mb-3"></i>
            <p>No featured products yet.</p>
        </div>
    @else
    <div class="row g-4">
        @foreach($featuredProducts as $product)
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card product-card shadow-sm h-100">
                <a href="{{ route('products.show', $product->slug) }}">
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/400x300/6366f1/FFFFFF?text=Product' }}"
                         class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                </a>
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-primary badge-category mb-2 align-self-start">{{ $product->category->name }}</span>
                    <h6 class="card-title fw-semibold">
                        <a href="{{ route('products.show', $product->slug) }}" class="text-dark text-decoration-none">{{ $product->name }}</a>
                    </h6>
                    <div class="mt-auto">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                @if($product->sale_price)
                                    <span class="fw-bold text-danger fs-5">${{ number_format($product->sale_price, 2) }}</span>
                                    <small class="text-muted text-decoration-line-through ms-1">${{ number_format($product->price, 2) }}</small>
                                @else
                                    <span class="fw-bold text-dark fs-5">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                        </div>
                        @auth
                        <form method="POST" action="{{ route('cart.add') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-cart-plus me-1"></i>Add to Cart
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
    @endif
</div>

<!-- Features Section -->
<div class="bg-white py-5 mt-3">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="p-3">
                    <i class="fas fa-shipping-fast fa-2x text-primary mb-3"></i>
                    <h6 class="fw-bold">Free Shipping</h6>
                    <small class="text-muted">On orders over $50</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <i class="fas fa-undo-alt fa-2x text-primary mb-3"></i>
                    <h6 class="fw-bold">Easy Returns</h6>
                    <small class="text-muted">30-day return policy</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <i class="fas fa-shield-alt fa-2x text-primary mb-3"></i>
                    <h6 class="fw-bold">Secure Payment</h6>
                    <small class="text-muted">100% secure checkout</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-3">
                    <i class="fas fa-headset fa-2x text-primary mb-3"></i>
                    <h6 class="fw-bold">24/7 Support</h6>
                    <small class="text-muted">Always here to help</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
