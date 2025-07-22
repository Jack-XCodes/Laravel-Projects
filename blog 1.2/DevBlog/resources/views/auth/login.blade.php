@extends('layouts.app')

@section('title', 'Sign In - DevBlog')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card animate-fade-up">
                    <!-- Auth Header -->
                    <div class="auth-header">
                        <h1 class="auth-title">Welcome Back</h1>
                        <p class="auth-subtitle">Sign in to continue your developer journey</p>
                    </div>

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="form-group-modern">
                            <label for="email" class="form-label-modern">
                                <i class="fas fa-envelope me-2 text-primary"></i>Email Address
                            </label>
                            <input id="email" 
                                   type="email" 
                                   class="form-control form-control-modern @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email" 
                                   placeholder="Enter your email address"
                                   autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="form-group-modern">
                            <label for="password" class="form-label-modern">
                                <i class="fas fa-lock me-2 text-primary"></i>Password
                            </label>
                            <div class="position-relative">
                                <input id="password" 
                                       type="password" 
                                       class="form-control form-control-modern @error('password') is-invalid @enderror" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password"
                                       placeholder="Enter your password">
                                <button type="button" 
                                        class="btn position-absolute end-0 top-50 translate-middle-y me-3"
                                        style="border: none; background: none; color: #9ca3af;"
                                        onclick="togglePassword()">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="remember-me">
                            <input type="checkbox" 
                                   name="remember" 
                                   id="remember" 
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="form-label-modern mb-0">
                                Keep me signed in
                            </label>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-auth btn-auth-primary">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In to DevBlog
                        </button>

                        <!-- Forgot Password Link -->
                        @if (Route::has('password.request'))
                            <div class="text-center mb-3">
                                <a class="auth-link" href="{{ route('password.request') }}">
                                    <i class="fas fa-question-circle me-1"></i>Forgot your password?
                                </a>
                            </div>
                        @endif

                        <!-- Divider -->
                        <div class="auth-divider">
                            <span>New to DevBlog?</span>
                        </div>

                        <!-- Register Link -->
                        <a href="{{ route('register') }}" class="btn btn-auth btn-auth-outline">
                            <i class="fas fa-user-plus me-2"></i>Create Your Account
                        </a>
                    </form>

                    <!-- Demo Account Info -->
                    <div class="mt-4 p-3 rounded-3" style="background-color: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2);">
                        <small style="color: #1f2937; font-weight: 600;">
                            <strong>Demo Account:</strong><br>
                            Email: john@devblog.com<br>
                            Password: password
                        </small>
                    </div>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-white text-decoration-none">
                        <i class="fas fa-arrow-left me-2"></i>Back to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function togglePassword() {
    const passwordField = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Add some interactive animations
document.addEventListener('DOMContentLoaded', function() {
    // Focus animations
    document.querySelectorAll('.form-control-modern').forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
    });
    
    // Button hover effects
    document.querySelectorAll('.btn-auth').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush
@endsection
