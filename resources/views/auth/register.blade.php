@extends('layouts.app')

@section('title', 'Register - MyStore')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fas fa-user-plus fa-3x text-success mb-3"></i>
                    <h3>Create Account</h3>
                    <p class="text-muted">Join us for exclusive deals!</p>
                </div>

                <form method="POST" action="/register">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" 
                               name="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}"
                               required 
                               autofocus>
                        @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" 
                               name="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" 
                               name="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <small class="text-muted">Minimum 8 characters</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" 
                               name="password_confirmation" 
                               class="form-control" 
                               required>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mb-3">
                        <i class="fas fa-user-plus me-2"></i>Register
                    </button>

                    <div class="text-center">
                        <p class="mb-0">
                            Already have an account? 
                            <a href="/login" class="text-decoration-none">Login here</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .card {
        border-radius: 20px;
        border: none;
    }
    
    .btn-success {
        padding: 12px;
    }
    
    body.dark-mode .card {
        background: #2d2d3a;
    }
</style>
@endpush