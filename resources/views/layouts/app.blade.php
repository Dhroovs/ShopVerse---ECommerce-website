<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopVerse - @yield('title', 'Your Ultimate Shopping Destination')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
        }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #6366f1, #4f46e5) !important; box-shadow: 0 2px 10px rgba(99,102,241,.3); }
        .navbar-brand { font-size: 1.5rem; font-weight: 700; letter-spacing: -0.5px; }
        .product-card { transition: transform .2s, box-shadow .2s; border: none; border-radius: 12px; overflow: hidden; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.15) !important; }
        .badge-category { font-size: .7rem; text-transform: uppercase; letter-spacing: .5px; }
        footer { background: linear-gradient(135deg, #1e293b, #0f172a); }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .toast-container { z-index: 9999; }
        .status-pending { background: #ffc107; color: #000; }
        .status-processing { background: #0dcaf0; color: #000; }
        .status-shipped { background: #0d6efd; color: #fff; }
        .status-delivered { background: #198754; color: #fff; }
        .status-cancelled { background: #dc3545; color: #fff; }
        .sidebar-admin { background: #1e293b; min-height: 100vh; }
        .sidebar-admin .nav-link { color: #94a3b8; border-radius: 8px; margin-bottom: 4px; }
        .sidebar-admin .nav-link:hover, .sidebar-admin .nav-link.active { background: #6366f1; color: #fff; }
        .hero-section { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%); min-height: 500px; }
    </style>
    @yield('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand text-white" href="{{ route('home') }}">
            <i class="fas fa-shopping-bag me-2"></i>ShopVerse
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('products.index') }}">Products</a>
                </li>
            </ul>
            <ul class="navbar-nav align-items-center">
                @auth
                    <li class="nav-item me-2">
                        <a class="nav-link text-white" href="{{ route('wishlist.index') }}">
                            <i class="fas fa-heart"></i>
                        </a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link text-white position-relative" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity'); @endphp
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="fas fa-box me-2"></i>My Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('wishlist.index') }}"><i class="fas fa-heart me-2"></i>Wishlist</a></li>
                            @if(auth()->user()->is_admin)
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-primary" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Admin Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light btn-sm ms-2" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="toast-container position-fixed top-0 end-0 p-3">
    @if(session('success'))
        <div class="toast show align-items-center text-white bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="toast show align-items-center text-white bg-danger border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body"><i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
</div>

@yield('content')

<footer class="text-white py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5 class="fw-bold mb-3"><i class="fas fa-shopping-bag me-2"></i>ShopVerse</h5>
                <p class="text-secondary">Your ultimate shopping destination for electronics, clothing, books, and more.</p>
            </div>
            <div class="col-md-2">
                <h6 class="fw-bold mb-3">Shop</h6>
                <ul class="list-unstyled text-secondary">
                    <li><a href="{{ route('products.index') }}" class="text-secondary text-decoration-none">All Products</a></li>
                    <li><a href="{{ route('home') }}" class="text-secondary text-decoration-none">Featured</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="fw-bold mb-3">Account</h6>
                <ul class="list-unstyled text-secondary">
                    @auth
                        <li><a href="{{ route('orders.index') }}" class="text-secondary text-decoration-none">My Orders</a></li>
                        <li><a href="{{ route('wishlist.index') }}" class="text-secondary text-decoration-none">Wishlist</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-secondary text-decoration-none">Login</a></li>
                        <li><a href="{{ route('register') }}" class="text-secondary text-decoration-none">Register</a></li>
                    @endauth
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="fw-bold mb-3">Contact</h6>
                <p class="text-secondary"><i class="fas fa-envelope me-2"></i>support@shopverse.com</p>
                <p class="text-secondary"><i class="fas fa-phone me-2"></i>+1 (555) 123-4567</p>
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <p class="text-center text-secondary mb-0">&copy; {{ date('Y') }} ShopVerse. All rights reserved.</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-dismiss toasts after 4 seconds
    document.querySelectorAll('.toast').forEach(function(toast) {
        setTimeout(function() {
            var bsToast = new bootstrap.Toast(toast);
            bsToast.hide();
        }, 4000);
    });
</script>
@yield('scripts')
</body>
</html>
