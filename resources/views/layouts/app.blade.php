<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MyStore - Premium Shopping Experience')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-color);
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Dark Mode */
        body.dark-mode {
            background: #1a1a2e;
            color: #f3f4f6;
        }

        body.dark-mode .navbar,
        body.dark-mode .card,
        body.dark-mode .category-box,
        body.dark-mode .testimonial,
        body.dark-mode .dropdown-menu,
        body.dark-mode .offcanvas {
            background: #2d2d3a;
            color: #f3f4f6;
        }

        body.dark-mode .card-body,
        body.dark-mode .dropdown-item {
            color: #f3f4f6;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            transition: var(--transition);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        body.dark-mode .navbar {
            background: rgba(45, 45, 58, 0.95);
        }

        .navbar.scrolled {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            padding: 0.5rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: var(--transition);
        }

        /* Search Bar */
        .search-wrapper {
            position: relative;
            width: 300px;
        }

        .search-input {
            border-radius: 50px;
            padding: 0.5rem 1rem;
            border: 2px solid #e5e7eb;
            transition: var(--transition);
            background: white;
        }

        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            max-height: 300px;
            overflow-y: auto;
        }

        body.dark-mode .search-suggestions {
            background: #2d2d3a;
        }

        /* Cart Dropdown */
        .cart-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 320px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            display: none;
            max-height: 400px;
            overflow-y: auto;
        }

        body.dark-mode .cart-dropdown {
            background: #2d2d3a;
        }

        .cart-item {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            transition: var(--transition);
        }

        .cart-item:hover {
            background: #f9fafb;
        }

        body.dark-mode .cart-item {
            border-color: #3f3f4e;
        }

        body.dark-mode .cart-item:hover {
            background: #3f3f4e;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        /* Toast Notifications */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast-notification {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: slideIn 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Loading Skeleton */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            border-radius: 8px;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 999;
            transition: var(--transition);
        }

        .fab:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            .fab {
                display: flex;
            }
        }

        /* Progress Bar */
        .progress-bar-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: rgba(102, 126, 234, 0.1);
            z-index: 10000;
        }

        .progress-bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            width: 0%;
            transition: width 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .search-wrapper {
                width: 100%;
                margin: 10px 0;
            }
            
            .navbar-collapse {
                padding: 1rem 0;
            }
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 30px;
            padding: 80px 20px;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
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

        /* Cards */
        .card {
            border-radius: 20px;
            transition: var(--transition);
            border: none;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #0f0f1a, #1a1a2e);
            color: white;
            padding: 60px 0 30px;
            margin-top: 60px;
        }

        body.dark-mode footer {
            background: linear-gradient(135deg, #000000, #1a1a2e);
        }

        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
            margin: 0 10px;
        }

        .footer-links a:hover {
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
            transition: var(--transition);
            color: white;
        }

        .social-icon:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Cookie Consent */
        .cookie-consent {
            position: fixed;
            bottom: 20px;
            left: 20px;
            right: 20px;
            background: white;
            border-radius: 16px;
            padding: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 9998;
            display: none;
            max-width: 400px;
        }

        body.dark-mode .cookie-consent {
            background: #2d2d3a;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Progress Bar -->
    <div class="progress-bar-container">
        <div class="progress-bar-fill"></div>
    </div>

    <!-- Floating Action Button -->
    <div class="fab" id="fab">
        <i class="fas fa-shopping-cart"></i>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top py-3" id="navbar">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="fas fa-store me-2"></i>MyStore
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Search Bar with Suggestions -->
                <div class="mx-auto search-wrapper">
                    <form method="GET" action="/" id="searchForm">
                        <input type="text" name="search" class="form-control search-input" 
                               placeholder="Search products..." id="searchInput" autocomplete="off">
                        <div class="search-suggestions" id="searchSuggestions"></div>
                    </form>
                </div>

                <!-- Navigation Items -->
                <div class="d-flex gap-2 ms-auto align-items-center">
                    <!-- Dark Mode Toggle -->
                    <button class="btn btn-outline-secondary" id="darkModeToggle">
                        <i class="fas fa-moon"></i>
                    </button>

                    <!-- Cart Dropdown -->
                    <div class="position-relative">
                        <button class="btn btn-outline-dark position-relative" id="cartBtn">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCount">
                                {{ count(session('cart', [])) }}
                            </span>
                        </button>
                        <div class="cart-dropdown" id="cartDropdown">
                            <div class="p-3">
                                <h6 class="fw-bold mb-3">Shopping Cart</h6>
                                <div id="cartItems">
                                    <p class="text-muted text-center">Your cart is empty</p>
                                </div>
                                <div id="cartTotal" class="mt-3 pt-3 border-top" style="display: none;">
                                    <div class="d-flex justify-content-between mb-2">
                                        <strong>Total:</strong>
                                        <strong id="cartTotalAmount">$0</strong>
                                    </div>
                                    <a href="/cart" class="btn btn-primary w-100">View Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Dropdown -->
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="/orders"><i class="fas fa-box me-2"></i>My Orders</a></li>
                                <li><a class="dropdown-item" href="/wishlist"><i class="fas fa-heart me-2"></i>Wishlist</a></li>
                                @if(Auth::user()->is_admin)
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="/admin"><i class="fas fa-tachometer-alt me-2"></i>Admin Panel</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button class="dropdown-item text-danger" type="submit">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="/login" class="btn btn-dark">
                            <i class="fas fa-user me-1"></i>Login
                        </a>
                        <a href="/register" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i>Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Enhanced Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h4 class="mb-3"><i class="fas fa-store me-2"></i>MyStore</h4>
                    <p class="text-muted">Premium shopping experience with the best products at unbeatable prices. Your satisfaction is our priority.</p>
                    <div class="mt-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <h6 class="fw-bold mb-3">Shop</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/" class="text-muted text-decoration-none">All Products</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">New Arrivals</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Best Sellers</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Sale</a></li>
                    </ul>
                </div>
                
                <div class="col-md-2">
                    <h6 class="fw-bold mb-3">Support</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Contact Us</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">FAQs</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Shipping Info</a></li>
                        <li class="mb-2"><a href="#" class="text-muted text-decoration-none">Returns</a></li>
                    </ul>
                </div>
                
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3">Newsletter</h6>
                    <p class="text-muted">Subscribe for exclusive offers and updates!</p>
                    <form id="newsletterForm">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email" id="newsletterEmail">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <hr class="mt-4 mb-3" style="background: rgba(255,255,255,0.1);">
            <div class="text-center">
                <p class="mb-0 text-muted">&copy; {{ date('Y') }} MyStore. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Cookie Consent -->
    <div class="cookie-consent" id="cookieConsent">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <i class="fas fa-cookie-bite me-2"></i>
                <small>We use cookies for better experience.</small>
            </div>
            <div>
                <button class="btn btn-sm btn-primary" id="acceptCookies">Accept</button>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
        }
        
        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                darkModeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            } else {
                localStorage.setItem('darkMode', 'disabled');
                darkModeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            }
        });

        // Cart Dropdown
        const cartBtn = document.getElementById('cartBtn');
        const cartDropdown = document.getElementById('cartDropdown');
        
        cartBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            cartDropdown.style.display = cartDropdown.style.display === 'block' ? 'none' : 'block';
            if (cartDropdown.style.display === 'block') {
                loadCartPreview();
            }
        });
        
        document.addEventListener('click', (e) => {
            if (!cartBtn.contains(e.target) && !cartDropdown.contains(e.target)) {
                cartDropdown.style.display = 'none';
            }
        });

        function loadCartPreview() {
            $.ajax({
                url: '/cart/preview',
                method: 'GET',
                success: function(response) {
                    if (response.items && response.items.length > 0) {
                        let html = '';
                        response.items.forEach(item => {
                            html += `
                                <div class="cart-item d-flex gap-2">
                                    <img src="${item.image}" width="50" height="50" style="object-fit: cover; border-radius: 8px;">
                                    <div class="flex-grow-1">
                                        <small class="d-block fw-bold">${item.name}</small>
                                        <small>$${item.price} x ${item.quantity}</small>
                                    </div>
                                    <small class="fw-bold">$${item.subtotal}</small>
                                </div>
                            `;
                        });
                        $('#cartItems').html(html);
                        $('#cartTotalAmount').text('$' + response.total);
                        $('#cartTotal').show();
                    } else {
                        $('#cartItems').html('<p class="text-muted text-center">Your cart is empty</p>');
                        $('#cartTotal').hide();
                    }
                }
            });
        }

        // Search Suggestions
        $('#searchInput').on('input', function() {
            const query = $(this).val();
            if (query.length > 1) {
                $.ajax({
                    url: '/search/suggestions',
                    method: 'GET',
                    data: { q: query },
                    success: function(data) {
                        if (data.length > 0) {
                            let html = '<div class="list-group">';
                            data.forEach(item => {
                                html += `<a href="/product/${item.id}" class="list-group-item list-group-item-action">${item.name}</a>`;
                            });
                            html += '</div>';
                            $('#searchSuggestions').html(html).show();
                        } else {
                            $('#searchSuggestions').hide();
                        }
                    }
                });
            } else {
                $('#searchSuggestions').hide();
            }
        });

        $(document).click(function(e) {
            if (!$(e.target).closest('.search-wrapper').length) {
                $('#searchSuggestions').hide();
            }
        });

        // Toast Notification System
        function showToast(message, type = 'success') {
            const toast = $(`
                <div class="toast-notification">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} text-${type}"></i>
                    <span>${message}</span>
                    <i class="fas fa-times ms-auto" style="cursor: pointer;"></i>
                </div>
            `);
            
            $('#toastContainer').append(toast);
            toast.find('.fa-times').click(() => toast.remove());
            
            setTimeout(() => {
                toast.fadeOut(300, () => toast.remove());
            }, 5000);
        }

        // Newsletter Subscription
        $('#newsletterForm').submit(function(e) {
            e.preventDefault();
            const email = $('#newsletterEmail').val();
            if (email) {
                showToast('Subscribed successfully!', 'success');
                $('#newsletterEmail').val('');
            }
        });

        // Cookie Consent
        if (!localStorage.getItem('cookiesAccepted')) {
            $('#cookieConsent').show();
        }
        
        $('#acceptCookies').click(function() {
            localStorage.setItem('cookiesAccepted', 'true');
            $('#cookieConsent').fadeOut();
            showToast('Cookies accepted!', 'success');
        });

        // Floating Action Button
        $('#fab').click(() => {
            window.location.href = '/cart';
        });

        // Progress Bar on Page Load
        window.addEventListener('beforeunload', () => {
            document.querySelector('.progress-bar-fill').style.width = '0%';
        });
        
        window.addEventListener('load', () => {
            const bar = document.querySelector('.progress-bar-fill');
            bar.style.width = '100%';
            setTimeout(() => {
                bar.style.width = '0%';
            }, 500);
        });
    </script>
    
    @stack('scripts')
</body>
</html>