@extends('layouts.app')
@section('title', 'Admin - Edit Product')
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
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3 class="fw-bold mb-0">Edit Product</h3>
            </div>
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger mb-4">
                            @foreach($errors->all() as $error)
                                <p class="mb-0"><i class="fas fa-exclamation-circle me-1"></i>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.products.update', $product) }}">
                        @csrf @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Product Name *</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $product->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Category *</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Description *</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                          rows="4" required>{{ old('description', $product->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Price ($) *</label>
                                <input type="number" name="price" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $product->price) }}" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Sale Price ($)</label>
                                <input type="number" name="sale_price" step="0.01" min="0" class="form-control @error('sale_price') is-invalid @enderror"
                                       value="{{ old('sale_price', $product->sale_price) }}">
                                @error('sale_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Stock *</label>
                                <input type="number" name="stock" min="0" class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock', $product->stock) }}" required>
                                @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Image URL</label>
                                <input type="url" name="image" class="form-control @error('image') is-invalid @enderror"
                                       value="{{ old('image', $product->image) }}" placeholder="https://...">
                                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="featured" id="featured" value="1"
                                           {{ old('featured', $product->featured) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="featured">
                                        <i class="fas fa-star text-warning me-1"></i>Featured Product
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i>Update Product
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
