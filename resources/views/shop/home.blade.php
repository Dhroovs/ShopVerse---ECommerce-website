@extends('layouts.app')

@section('title', 'MyStore - Premium Shopping Experience')

@section('content')

<!-- Hero Carousel -->
<div id="heroCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="hero text-center" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                <h1 class="fw-bold display-4 mb-3">Upgrade Your Lifestyle</h1>
                <p class="lead mb-4">Shop premium products with best prices</p>
                <a href="#products" class="btn btn-light btn-lg px-5">Explore Now</a>
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero text-center" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                <h1 class="fw-bold display-4 mb-3">Summer Sale</h1>
                <p class="lead mb-4">Get up to 70% off on selected items</p>
                <a href="#" class="btn btn-light btn-lg px-5">Shop Now</a>
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero text-center" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                <h1 class="fw-bold display-4 mb-3">Free Shipping</h1>
                <p class="lead mb-4">On orders above ₹999</p>
                <a href="#" class="btn btn-light btn-lg px-5">Learn More</a>
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

<!-- Categories Section -->
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Shop by Category</h3>
        <a href="#" class="text-decoration-none">View All →</a>
    </div>
    
    <div class="row g-4">
        <div class="col-md-3 col-6">
            <div class="category-box text-center">
                <i class="fas fa-tshirt fa-3x mb-3" style="color: #667eea;"></i>
                <h5 class="mb-0">Clothing</h5>
                <small class="text-muted">120+ items</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="category-box text-center">
                <i class="fas fa-shoe-prints fa-3x mb-3" style="color: #f5576c;"></i>
                <h5 class="mb-0">Shoes</h5>
                <small class="text-muted">85+ items</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="category-box text-center">
                <i class="fas fa-gem fa-3x mb-3" style="color: #4facfe;"></i>
                <h5 class="mb-0">Accessories</h5>
                <small class="text-muted">200+ items</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="category-box text-center">
                <i class="fas fa-mobile-alt fa-3x mb-3" style="color: #10b981;"></i>
                <h5 class="mb-0">Electronics</h5>
                <small class="text-muted">50+ items</small>
            </div>
        </div>
    </div>
</div>

<!-- Promo Banner 1 -->
<div class="row mb-5">
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="promo-banner" style="background: linear-gradient(135deg, #667eea, #764ba2);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bold mb-2">Limited Time Offer</h3>
                    <p class="mb-3">Get 30% off on all electronics</p>
                    <a href="#" class="btn btn-light btn-sm">Shop Now →</a>
                </div>
                <i class="fas fa-laptop-code fa-4x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="promo-banner" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bold mb-2">New Arrivals</h3>
                    <p class="mb-3">Summer collection 2024</p>
                    <a href="#" class="btn btn-light btn-sm">Shop Now →</a>
                </div>
                <i class="fas fa-sun fa-4x opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Products Section -->
<div id="products">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">🔥 Trending Products</h3>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" id="sortProducts" style="width: auto;">
                <option value="latest">Latest</option>
                <option value="price_low">Price: Low to High</option>
                <option value="price_high">Price: High to Low</option>
                <option value="popular">Most Popular</option>
            </select>
        </div>
    </div>
    
    <div class="row g-4" id="productsGrid">
        @forelse($products as $product)
        <div class="col-md-3 col-6">
            <div class="product-card card h-100 position-relative">
                <!-- Wishlist Button -->
                <button class="wishlist-btn" onclick="toggleWishlist({{ $product->id }})">
                    <i class="far fa-heart"></i>
                </button>
                
                <!-- Product Badge -->
                @if($loop->index < 3)
                    <span class="product-badge bg-danger">HOT</span>
                @endif
                
                <!-- Product Image -->
                <a href="/product/{{ $product->id }}" class="product-image-wrapper">
                    <img src="https://picsum.photos/300/300?random={{ $product->id }}" 
                         class="card-img-top" 
                         alt="{{ $product->name }}"
                         style="height: 250px; width: 100%; object-fit: cover;">
                    <div class="quick-view-overlay">
                        <button class="btn btn-light btn-sm" onclick="quickView({{ $product->id }})">
                            <i class="fas fa-eye"></i> Quick View
                        </button>
                    </div>
                </a>
                
                <div class="card-body text-center">
                    <h6 class="product-title mb-2">{{ $product->name }}</h6>
                    
                    <!-- Rating -->
                    <div class="rating mb-2">
                        @php
                            $rating = rand(3, 5);
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $rating)
                                <i class="fas fa-star text-warning"></i>
                            @else
                                <i class="far fa-star text-warning"></i>
                            @endif
                        @endfor
                        <small class="text-muted">({{ rand(10, 500) }})</small>
                    </div>
                    
                    <!-- Price -->
                    <p class="fw-bold text-primary mb-2">₹{{ number_format($product->price, 2) }}</p>
                    
                    <!-- Add to Cart Button -->
                    <form method="POST" action="/cart/add/{{ $product->id }}" class="add-to-cart-form">
                        @csrf
                        <button type="submit" class="btn btn-dark w-100">
                            <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p>No products found.</p>
        </div>
        @endforelse
    </div>
    
    <!-- Load More Button -->
    @if(count($products) >= 8)
    <div class="text-center mt-5">
        <button class="btn btn-outline-primary btn-lg" id="loadMoreBtn">
            <i class="fas fa-spinner fa-spin d-none"></i>
            Load More Products
        </button>
    </div>
    @endif
</div>

<!-- Promo Banner 2 -->
<div class="promo text-center mt-5">
    <h2 class="fw-bold display-5 mb-3">Flat 50% OFF</h2>
    <p class="lead mb-4">Limited time offer on selected items</p>
    <a href="#" class="btn btn-light btn-lg">Shop Sale →</a>
</div>

<!-- New Arrivals Section -->
@if(isset($products) && count($products) > 0)
<div class="mt-5">
    <h3 class="fw-bold mb-4">✨ New Arrivals</h3>
    <div class="row g-4">
        @foreach($products->take(4) as $product)
        <div class="col-md-3 col-6">
            <div class="new-arrival-card card h-100">
                <img src="https://picsum.photos/300/300?random=new{{ $product->id }}" 
                     class="card-img-top" 
                     alt="{{ $product->name }}"
                     style="height: 200px; width: 100%; object-fit: cover;">
                <div class="card-body">
                    <h6 class="mb-2">{{ $product->name }}</h6>
                    <p class="fw-bold text-primary mb-0">₹{{ number_format($product->price, 2) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Testimonials Section -->
<div class="mt-5">
    <h3 class="fw-bold mb-4 text-center">What Our Customers Say</h3>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="testimonial-card text-center">
                <img src="https://randomuser.me/api/portraits/women/1.jpg" class="rounded-circle mb-3" width="80" height="80" alt="Customer">
                <div class="rating mb-2">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                </div>
                <p class="mb-2">"Amazing quality products! Fast delivery and great customer support. Highly recommended!"</p>
                <h6 class="fw-bold mb-0">Sarah Johnson</h6>
                <small class="text-muted">Verified Buyer</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial-card text-center">
                <img src="https://randomuser.me/api/portraits/men/2.jpg" class="rounded-circle mb-3" width="80" height="80" alt="Customer">
                <div class="rating mb-2">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star-half-alt text-warning"></i>
                </div>
                <p class="mb-2">"Best shopping experience ever! The products are exactly as described. Will shop again!"</p>
                <h6 class="fw-bold mb-0">Michael Chen</h6>
                <small class="text-muted">Verified Buyer</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testimonial-card text-center">
                <img src="https://randomuser.me/api/portraits/women/3.jpg" class="rounded-circle mb-3" width="80" height="80" alt="Customer">
                <div class="rating mb-2">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="far fa-star text-warning"></i>
                </div>
                <p class="mb-2">"Love the quality and prices! The delivery was super fast. Definitely my go-to store now."</p>
                <h6 class="fw-bold mb-0">Emily Rodriguez</h6>
                <small class="text-muted">Verified Buyer</small>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<button id="backToTop" class="btn btn-primary rounded-circle" style="position: fixed; bottom: 80px; right: 30px; width: 50px; height: 50px; display: none; z-index: 999;">
    <i class="fas fa-arrow-up"></i>
</button>

@endsection

@push('styles')
<style>
    /* Categories */
    .category-box {
        padding: 30px 20px;
        border-radius: 20px;
        background: white;
        text-align: center;
        transition: all 0.3s;
        cursor: pointer;
    }
    
    body.dark-mode .category-box {
        background: #2d2d3a;
        color: #f3f4f6;
    }
    
    .category-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 30px rgba(0,0,0,0.1);
    }
    
    /* Promo Banner */
    .promo-banner {
        color: white;
        padding: 40px;
        border-radius: 20px;
        transition: transform 0.3s;
        cursor: pointer;
    }
    
    .promo-banner:hover {
        transform: scale(1.02);
    }
    
    /* Product Cards */
    .product-card {
        position: relative;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    body.dark-mode .product-card {
        background: #2d2d3a;
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .product-image-wrapper {
        position: relative;
        overflow: hidden;
        display: block;
    }
    
    .product-card:hover .card-img-top {
        transform: scale(1.1);
        transition: transform 0.5s ease;
    }
    
    .quick-view-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    .product-image-wrapper:hover .quick-view-overlay {
        opacity: 1;
    }
    
    .wishlist-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: white;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        z-index: 10;
    }
    
    .wishlist-btn:hover {
        background: #ef4444;
        color: white;
        transform: scale(1.1);
    }
    
    .product-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        z-index: 10;
        color: white;
    }
    
    .product-title {
        font-size: 14px;
        font-weight: 600;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Testimonial Card */
    .testimonial-card {
        background: white;
        padding: 30px;
        border-radius: 20px;
        transition: all 0.3s;
    }
    
    body.dark-mode .testimonial-card {
        background: #2d2d3a;
        color: #f3f4f6;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    /* Promo */
    .promo {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 80px 20px;
        border-radius: 30px;
        position: relative;
        overflow: hidden;
    }
    
    .promo::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1%, transparent 1%);
        background-size: 50px 50px;
        animation: shimmer 20s linear infinite;
    }
    
    @keyframes shimmer {
        from { transform: translate(0, 0); }
        to { transform: translate(50px, 50px); }
    }
    
    /* New Arrival Card */
    .new-arrival-card {
        transition: all 0.3s;
    }
    
    body.dark-mode .new-arrival-card {
        background: #2d2d3a;
    }
    
    .new-arrival-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .promo-banner {
            padding: 25px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Wishlist Toggle
    function toggleWishlist(productId) {
        if (typeof $ !== 'undefined') {
            $.ajax({
                url: '/wishlist/toggle',
                method: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.added) {
                        showToast('Added to wishlist!', 'success');
                    } else {
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
    }
    
    // Quick View
    function quickView(productId) {
        showToast('Quick view coming soon!', 'info');
    }
    
    // Sort Products
    if (typeof $ !== 'undefined') {
        $('#sortProducts').change(function() {
            var sort = $(this).val();
            $.ajax({
                url: '/products/sort',
                method: 'GET',
                data: { sort: sort },
                success: function(html) {
                    if (html) {
                        $('#productsGrid').html(html);
                        showToast('Products sorted!', 'success');
                    }
                },
                error: function() {
                    showToast('Error sorting products', 'error');
                }
            });
        });
    }
    
    // Load More Products
    var page = 1;
    if (typeof $ !== 'undefined') {
        $('#loadMoreBtn').click(function() {
            var btn = $(this);
            btn.prop('disabled', true);
            btn.find('.fa-spinner').removeClass('d-none');
            
            page++;
            $.ajax({
                url: '/products/load-more',
                method: 'GET',
                data: { page: page },
                success: function(html) {
                    if (html && html.trim()) {
                        $('#productsGrid').append(html);
                        btn.prop('disabled', false);
                        btn.find('.fa-spinner').addClass('d-none');
                    } else {
                        btn.text('No More Products');
                        btn.prop('disabled', true);
                    }
                },
                error: function() {
                    btn.prop('disabled', false);
                    btn.find('.fa-spinner').addClass('d-none');
                    showToast('Error loading products', 'error');
                }
            });
        });
    }
    
    // Back to Top
    if (typeof window !== 'undefined') {
        window.addEventListener('scroll', function() {
            var backToTop = document.getElementById('backToTop');
            if (backToTop) {
                if (window.pageYOffset > 500) {
                    backToTop.style.display = 'flex';
                } else {
                    backToTop.style.display = 'none';
                }
            }
        });
        
        var backToTopBtn = document.getElementById('backToTop');
        if (backToTopBtn) {
            backToTopBtn.addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    }
    
    // Add to Cart AJAX
    if (typeof $ !== 'undefined') {
        $('.add-to-cart-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            
            $.ajax({
                url: url,
                method: 'POST',
                data: form.serialize(),
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