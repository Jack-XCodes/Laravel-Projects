@extends('layouts.app')

@section('title', 'Login - DevBlog Platform')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-sign-in-alt me-2"></i>Welcome Back
                </h4>
                <p class="text-muted mb-0">Sign in to your account</p>
            </div>
            <div class="card-body">
                <!-- Sprint 1 - Login form with email/password authentication -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
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
                               placeholder="Enter your password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Sprint 1 - Remember Me checkbox for session persistence -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me on this device
                        </label>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </div>
                </form>
                
                <!-- Sprint 1 - Forgot Password Link (placeholder for future enhancement) -->
                <div class="text-center mt-3">
                    <a href="#" class="text-muted text-decoration-none">
                        <i class="fas fa-question-circle me-1"></i>
                        Forgot your password? (Coming soon)
                    </a>
                </div>
            </div>
            
            <!-- Sprint 1 - Link to registration page -->
            <div class="card-footer text-center">
                <p class="mb-0">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-decoration-none">
                        <i class="fas fa-user-plus me-1"></i>Create one here
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
