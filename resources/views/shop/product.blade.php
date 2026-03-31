@extends('layouts.app')

@section('title', $product->name . ' - MyStore')

@section('content')

<div class="row g-4">
    <!-- Product Images Gallery -->
    <div class="col-md-6">
        <!-- Main Image -->
        <div class="main-image-container mb-3">
            <img src="https://picsum.photos/600/500?random={{ $product->id }}" 
                 class="img-fluid rounded-4 shadow-sm w-100" 
                 alt="{{ $product->name }}"
                 id="mainImage"
                 style="height: 500px; object-fit: cover;">
        </div>
        
        <!-- Thumbnail Gallery -->
        <div class="row g-2 mt-2">
            <div class="col-3">
                <img src="https://picsum.photos/200/200?random={{ $product->id }}-1" 
                     class="img-fluid rounded-3 thumbnail" 
                     alt="Thumbnail 1"
                     style="height: 100px; width: 100%; object-fit: cover; cursor: pointer;">
            </div>
            <div class="col-3">
                <img src="https://picsum.photos/200/200?random={{ $product->id }}-2" 
                     class="img-fluid rounded-3 thumbnail" 
                     alt="Thumbnail 2"
                     style="height: 100px; width: 100%; object-fit: cover; cursor: pointer;">
            </div>
            <div class="col-3">
                <img src="https://picsum.photos/200/200?random={{ $product->id }}-3" 
                     class="img-fluid rounded-3 thumbnail" 
                     alt="Thumbnail 3"
                     style="height: 100px; width: 100%; object-fit: cover; cursor: pointer;">
            </div>
            <div class="col-3">
                <img src="https://picsum.photos/200/200?random={{ $product->id }}-4" 
                     class="img-fluid rounded-3 thumbnail" 
                     alt="Thumbnail 4"
                     style="height: 100px; width: 100%; object-fit: cover; cursor: pointer;">
            </div>
        </div>
    </div>

    <!-- Product Details -->
    <div class="col-md-6">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">{{ $product->category ?? 'Products' }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <!-- Product Title -->
        <h1 class="fw-bold mb-2">{{ $product->name }}</h1>
        
        <!-- Rating -->
        <div class="d-flex align-items-center mb-3">
            <div class="rating me-2">
                @php
                    $rating = rand(4, 5);
                    $reviewCount = rand(50, 500);
                @endphp
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $rating)
                        <i class="fas fa-star text-warning"></i>
                    @elseif($i == floor($rating) + 1 && $rating - floor($rating) >= 0.5)
                        <i class="fas fa-star-half-alt text-warning"></i>
                    @else
                        <i class="far fa-star text-warning"></i>
                    @endif
                @endfor
            </div>
            <span class="text-muted">({{ $reviewCount }} reviews)</span>
            <span class="mx-2">|</span>
            <span class="text-success">
                <i class="fas fa-check-circle"></i> In Stock
            </span>
        </div>

        <!-- Price -->
        <div class="mb-4">
            @php
                $oldPrice = $product->price * 1.3;
                $discount = rand(10, 30);
            @endphp
            <h2 class="fw-bold text-primary d-inline-block me-3">₹{{ number_format($product->price, 2) }}</h2>
            <span class="text-muted text-decoration-line-through fs-5">₹{{ number_format($oldPrice, 2) }}</span>
            <span class="badge bg-danger ms-2 fs-6">{{ $discount }}% OFF</span>
        </div>

        <!-- Description -->
        <div class="mb-4">
            <h5 class="fw-bold mb-2">Product Description</h5>
            <p class="text-muted">{{ $product->description ?? 'Experience premium quality with this amazing product. Perfect for everyday use, designed with comfort and style in mind.' }}</p>
        </div>

        <!-- Variations -->
        <div class="mb-4">
            <h5 class="fw-bold mb-2">Color</h5>
            <div class="d-flex gap-2 mb-3">
                <button class="color-option active" style="background: #000000; width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ddd;"></button>
                <button class="color-option" style="background: #ffffff; width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ddd;"></button>
                <button class="color-option" style="background: #667eea; width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ddd;"></button>
                <button class="color-option" style="background: #ef4444; width: 40px; height: 40px; border-radius: 50%; border: 2px solid #ddd;"></button>
            </div>
            
            <h5 class="fw-bold mb-2">Size</h5>
            <div class="d-flex gap-2 mb-3">
                <button class="size-option btn btn-outline-secondary">S</button>
                <button class="size-option btn btn-outline-secondary">M</button>
                <button class="size-option btn btn-outline-secondary">L</button>
                <button class="size-option btn btn-outline-secondary">XL</button>
                <button class="size-option btn btn-outline-secondary">XXL</button>
            </div>
        </div>

        <!-- Stock Indicator -->
        <div class="mb-4">
            <div class="d-flex justify-content-between mb-1">
                <small class="text-muted">Available Stock</small>
                <small class="text-muted fw-bold">Only {{ rand(10, 50) }} left!</small>
            </div>
            <div class="progress" style="height: 8px;">
                <div class="progress-bar bg-warning" style="width: {{ rand(30, 70) }}%"></div>
            </div>
        </div>

        <!-- Quantity and Add to Cart -->
        <div class="mb-4">
            <h5 class="fw-bold mb-2">Quantity</h5>
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="quantity-selector d-flex align-items-center border rounded">
                    <button type="button" class="btn btn-link text-decoration-none px-3" id="decreaseQty">−</button>
                    <input type="number" id="quantity" value="1" min="1" max="99" style="width: 60px; text-align: center; border: none;">
                    <button type="button" class="btn btn-link text-decoration-none px-3" id="increaseQty">+</button>
                </div>
                <button class="btn btn-dark btn-lg flex-grow-1" id="addToCartBtn">
                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                </button>
                <button class="btn btn-outline-danger btn-lg" id="wishlistBtn">
                    <i class="far fa-heart"></i>
                </button>
            </div>
        </div>

        <!-- Delivery Info -->
        <div class="border-top pt-3">
            <div class="row g-2">
                <div class="col-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-truck fa-lg text-primary"></i>
                        <div>
                            <small class="d-block fw-bold">Free Delivery</small>
                            <small class="text-muted">On orders above ₹999</small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-undo-alt fa-lg text-primary"></i>
                        <div>
                            <small class="d-block fw-bold">30 Days Return</small>
                            <small class="text-muted">Easy returns policy</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Share Buttons -->
        <div class="mt-3">
            <small class="text-muted d-block mb-2">Share this product:</small>
            <div class="d-flex gap-2">
                <a href="#" class="btn btn-sm btn-outline-primary"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="btn btn-sm btn-outline-info"><i class="fab fa-twitter"></i></a>
                <a href="#" class="btn btn-sm btn-outline-danger"><i class="fab fa-instagram"></i></a>
                <a href="#" class="btn btn-sm btn-outline-success"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- Product Details Tabs -->
<div class="row mt-5">
    <div class="col-12">
        <ul class="nav nav-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
                    Description
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab">
                    Specifications
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                    Reviews ({{ $reviewCount }})
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab">
                    Shipping Info
                </button>
            </li>
        </ul>
        
        <div class="tab-content p-4 border border-top-0 rounded-bottom">
            <!-- Description Tab -->
            <div class="tab-pane fade show active" id="description" role="tabpanel">
                <h5 class="fw-bold mb-3">Product Details</h5>
                <p>{{ $product->description ?? 'This premium product is designed to provide the best experience. Made with high-quality materials and crafted with attention to detail.' }}</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Premium quality materials</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Comfortable and stylish design</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Durable and long-lasting</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Easy to maintain</li>
                </ul>
            </div>
            
            <!-- Specifications Tab -->
            <div class="tab-pane fade" id="specifications" role="tabpanel">
                <h5 class="fw-bold mb-3">Technical Specifications</h5>
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 200px;">Brand</th>
                        <td>MyStore</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $product->category ?? 'General' }}</td>
                    </tr>
                    <tr>
                        <th>Material</th>
                        <td>Premium Quality</td>
                    </tr>
                    <tr>
                        <th>Warranty</th>
                        <td>1 Year</td>
                    </tr>
                    <tr>
                        <th>Country of Origin</th>
                        <td>India</td>
                    </tr>
                </table>
            </div>
            
            <!-- Reviews Tab -->
            <div class="tab-pane fade" id="reviews" role="tabpanel">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="text-center p-3 bg-light rounded">
                            <h1 class="display-1 fw-bold text-primary">{{ number_format($rating, 1) }}</h1>
                            <div class="rating mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $rating)
                                        <i class="fas fa-star text-warning"></i>
                                    @elseif($i == floor($rating) + 1 && $rating - floor($rating) >= 0.5)
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    @else
                                        <i class="far fa-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="mb-0">Based on {{ $reviewCount }} reviews</p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span>5 Star</span>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                </div>
                                <span>70%</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span>4 Star</span>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-success" style="width: 20%"></div>
                                </div>
                                <span>20%</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span>3 Star</span>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-warning" style="width: 5%"></div>
                                </div>
                                <span>5%</span>
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span>2 Star</span>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-danger" style="width: 3%"></div>
                                </div>
                                <span>3%</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span>1 Star</span>
                                <div class="progress flex-grow-1" style="height: 8px;">
                                    <div class="progress-bar bg-danger" style="width: 2%"></div>
                                </div>
                                <span>2%</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sample Reviews -->
                <div class="mt-4">
                    <h5 class="fw-bold mb-3">Customer Reviews</h5>
                    <div class="review-item border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <strong>Rahul Sharma</strong>
                                <div class="rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                </div>
                            </div>
                            <small class="text-muted">2 days ago</small>
                        </div>
                        <p class="mb-1">Amazing product! Very satisfied with the quality. Delivery was prompt.</p>
                        <small class="text-success">Verified Purchase</small>
                    </div>
                    
                    <div class="review-item border-bottom pb-3 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <strong>Priya Patel</strong>
                                <div class="rating">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="far fa-star text-warning"></i>
                                </div>
                            </div>
                            <small class="text-muted">5 days ago</small>
                        </div>
                        <p class="mb-1">Good product for the price. Would recommend to others.</p>
                        <small class="text-success">Verified Purchase</small>
                    </div>
                </div>
                
                <button class="btn btn-outline-primary mt-2">Write a Review</button>
            </div>
            
            <!-- Shipping Tab -->
            <div class="tab-pane fade" id="shipping" role="tabpanel">
                <h5 class="fw-bold mb-3">Shipping Information</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Free shipping on orders above ₹999</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Standard delivery: 3-5 business days</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Express delivery: 1-2 business days (additional charges apply)</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Easy returns within 30 days</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Cash on delivery available</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Related Products Section -->
@if(isset($relatedProducts) && count($relatedProducts) > 0)
<div class="mt-5">
    <h3 class="fw-bold mb-4">You May Also Like</h3>
    <div class="row g-4">
        @foreach($relatedProducts as $relatedProduct)
        <div class="col-md-3 col-6">
            <div class="card h-100">
                <a href="/product/{{ $relatedProduct->id }}">
                    <img src="https://picsum.photos/300/300?random=related{{ $relatedProduct->id }}" 
                         class="card-img-top" 
                         alt="{{ $relatedProduct->name }}"
                         style="height: 200px; object-fit: cover;">
                </a>
                <div class="card-body">
                    <h6 class="product-title mb-2">{{ $relatedProduct->name }}</h6>
                    <p class="fw-bold text-primary mb-0">₹{{ number_format($relatedProduct->price, 2) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<!-- Fallback Related Products -->
<div class="mt-5">
    <h3 class="fw-bold mb-4">You May Also Like</h3>
    <div class="row g-4">
        @php
            $fallbackProducts = \App\Models\Product::where('id', '!=', $product->id)->limit(4)->get();
        @endphp
        @foreach($fallbackProducts as $relatedProduct)
        <div class="col-md-3 col-6">
            <div class="card h-100">
                <a href="/product/{{ $relatedProduct->id }}">
                    <img src="https://picsum.photos/300/300?random=related{{ $relatedProduct->id }}" 
                         class="card-img-top" 
                         alt="{{ $relatedProduct->name }}"
                         style="height: 200px; object-fit: cover;">
                </a>
                <div class="card-body">
                    <h6 class="product-title mb-2">{{ $relatedProduct->name }}</h6>
                    <p class="fw-bold text-primary mb-0">₹{{ number_format($relatedProduct->price, 2) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Sticky Mobile Add to Cart Bar -->
<div class="mobile-sticky-bar d-md-none">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-2">
            <div>
                <h5 class="fw-bold mb-0">₹{{ number_format($product->price, 2)}}</h5>
                <small class="text-success">In Stock</small>
            </div>
            <button class="btn btn-dark btn-lg" id="mobileAddToCartBtn">
                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
            </button>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Main Image Container */
    .main-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
    }
    
    /* Thumbnail Hover Effect */
    .thumbnail {
        transition: all 0.3s;
        opacity: 0.7;
    }
    
    .thumbnail:hover {
        opacity: 1;
        transform: scale(1.05);
    }
    
    /* Color Options */
    .color-option {
        transition: all 0.3s;
        cursor: pointer;
    }
    
    .color-option:hover {
        transform: scale(1.1);
        box-shadow: 0 0 0 2px #fff, 0 0 0 4px #667eea;
    }
    
    .color-option.active {
        box-shadow: 0 0 0 2px #fff, 0 0 0 4px #667eea;
    }
    
    /* Size Options */
    .size-option {
        transition: all 0.3s;
        min-width: 50px;
    }
    
    .size-option:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    
    .size-option.active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    
    /* Quantity Selector */
    .quantity-selector input {
        outline: none;
    }
    
    .quantity-selector input::-webkit-inner-spin-button,
    .quantity-selector input::-webkit-outer-spin-button {
        opacity: 1;
    }
    
    /* Product Title */
    .product-title {
        font-size: 14px;
        font-weight: 600;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Tabs */
    .nav-tabs .nav-link {
        color: #6c757d;
        font-weight: 500;
    }
    
    .nav-tabs .nav-link.active {
        color: #667eea;
        font-weight: 600;
    }
    
    /* Mobile Sticky Bar */
    .mobile-sticky-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: white;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        z-index: 999;
        display: none;
    }
    
    body.dark-mode .mobile-sticky-bar {
        background: #2d2d3a;
    }
    
    @media (max-width: 768px) {
        .mobile-sticky-bar {
            display: block;
        }
        
        body {
            padding-bottom: 80px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Thumbnail Gallery
    var thumbnails = document.querySelectorAll('.thumbnail');
    var mainImage = document.getElementById('mainImage');
    
    thumbnails.forEach(function(thumbnail) {
        thumbnail.addEventListener('click', function() {
            mainImage.src = this.src;
        });
    });
    
    // Color Selection
    var colorOptions = document.querySelectorAll('.color-option');
    colorOptions.forEach(function(option) {
        option.addEventListener('click', function() {
            colorOptions.forEach(function(opt) {
                opt.classList.remove('active');
            });
            this.classList.add('active');
            showToast('Color selected', 'success');
        });
    });
    
    // Size Selection
    var sizeOptions = document.querySelectorAll('.size-option');
    sizeOptions.forEach(function(option) {
        option.addEventListener('click', function() {
            sizeOptions.forEach(function(opt) {
                opt.classList.remove('active');
                opt.classList.remove('btn-dark');
                opt.classList.add('btn-outline-secondary');
            });
            this.classList.add('active');
            this.classList.remove('btn-outline-secondary');
            this.classList.add('btn-dark');
            showToast('Size selected: ' + this.innerText, 'success');
        });
    });
    
    // Quantity Selector
    var quantityInput = document.getElementById('quantity');
    var decreaseBtn = document.getElementById('decreaseQty');
    var increaseBtn = document.getElementById('increaseQty');
    
    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', function() {
            var currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    }
    
    if (increaseBtn) {
        increaseBtn.addEventListener('click', function() {
            var currentValue = parseInt(quantityInput.value);
            if (currentValue < 99) {
                quantityInput.value = currentValue + 1;
            }
        });
    }
    
    // Add to Cart Function
    function addToCart(productId, quantity) {
        if (typeof $ !== 'undefined') {
            $.ajax({
                url: '/cart/add/' + productId,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity
                },
                success: function(response) {
                    showToast('Added to cart!', 'success');
                    if (response.cart_count !== undefined) {
                        $('#cartCount').text(response.cart_count);
                    }
                },
                error: function() {
                    showToast('Please login to add to cart', 'error');
                }
            });
        } else {
            // Fallback form submission
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '/cart/add/{{ $product->id }}';
            var csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            var quantityInput = document.createElement('input');
            quantityInput.type = 'hidden';
            quantityInput.name = 'quantity';
            quantityInput.value = quantity;
            form.appendChild(csrfInput);
            form.appendChild(quantityInput);
            document.body.appendChild(form);
            form.submit();
        }
    }
    
    // Add to Cart Button
    var addToCartBtn = document.getElementById('addToCartBtn');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            var quantity = parseInt(quantityInput.value);
            addToCart({{ $product->id }}, quantity);
        });
    }
    
    // Mobile Add to Cart Button
    var mobileAddToCartBtn = document.getElementById('mobileAddToCartBtn');
    if (mobileAddToCartBtn) {
        mobileAddToCartBtn.addEventListener('click', function() {
            var quantity = parseInt(quantityInput.value);
            addToCart({{ $product->id }}, quantity);
        });
    }
    
    // Wishlist Button
    var wishlistBtn = document.getElementById('wishlistBtn');
    if (wishlistBtn) {
        wishlistBtn.addEventListener('click', function() {
            if (typeof $ !== 'undefined') {
                $.ajax({
                    url: '/wishlist/toggle',
                    method: 'POST',
                    data: {
                        product_id: {{ $product->id }},
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.added) {
                            wishlistBtn.innerHTML = '<i class="fas fa-heart"></i>';
                            showToast('Added to wishlist!', 'success');
                        } else {
                            wishlistBtn.innerHTML = '<i class="far fa-heart"></i>';
                            showToast('Removed from wishlist', 'info');
                        }
                    },
                    error: function() {
                        showToast('Please login to add to wishlist', 'error');
                    }
                });
            } else {
                showToast('Please login to add to wishlist', 'error');
            }
        });
    }
    
    // Show Toast Function
    function showToast(message, type) {
        type = type || 'success';
        var toastContainer = document.getElementById('toastContainer');
        if (!toastContainer) return;
        
        var toast = document.createElement('div');
        toast.className = 'toast-notification';
        var icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
        toast.innerHTML = '<i class="fas fa-' + icon + ' text-' + type + '"></i>' +
            '<span>' + message + '</span>' +
            '<i class="fas fa-times ms-auto" style="cursor: pointer;"></i>';
        
        toastContainer.appendChild(toast);
        
        var closeBtn = toast.querySelector('.fa-times');
        closeBtn.addEventListener('click', function() { toast.remove(); });
        
        setTimeout(function() {
            if (toast && toast.parentNode) {
                toast.style.opacity = '0';
                setTimeout(function() {
                    if (toast && toast.parentNode) toast.remove();
                }, 300);
            }
        }, 5000);
    }
</script>
@endpush