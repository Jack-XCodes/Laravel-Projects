@extends('layouts.app')

@section('title', 'Register - DevBlog Platform')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-user-plus me-2"></i>Create Your Account
                </h4>
                <p class="text-muted mb-0">Join our community of writers and readers</p>
            </div>
            <div class="card-body">
                <!-- Sprint 1 - Registration form with username field -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <!-- Full Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               placeholder="Enter your full name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Sprint 1 - Username Field for profile URLs -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" 
                               class="form-control @error('username') is-invalid @enderror" 
                               id="username" 
                               name="username" 
                               value="{{ old('username') }}" 
                               required 
                               placeholder="Choose a unique username">
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            This will be your unique identifier. Use letters, numbers, underscores, or dashes only.
                        </div>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="Enter your email address">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required 
                               placeholder="Create a strong password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Confirm Password Field -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required 
                               placeholder="Confirm your password">
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Create Account
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Sprint 1 - Link to login page -->
            <div class="card-footer text-center">
                <p class="mb-0">Already have an account? 
                    <a href="{{ route('login') }}" class="text-decoration-none">
                        <i class="fas fa-sign-in-alt me-1"></i>Sign in here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
