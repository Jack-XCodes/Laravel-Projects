@extends('layouts.app')

@section('title', 'Join DevBlog - Create Account')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center py-5" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="auth-card animate-fade-up">
                    <!-- Auth Header -->
                    <div class="auth-header">
                        <h1 class="auth-title">Join DevBlog</h1>
                        <p class="auth-subtitle">Create your account and start your developer journey</p>
                    </div>

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <!-- Name Field -->
                        <div class="form-group-modern">
                            <label for="name" class="form-label-modern">
                                <i class="fas fa-user me-2 text-primary"></i>Full Name
                            </label>
                            <input id="name" 
                                   type="text" 
                                   class="form-control form-control-modern @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autocomplete="name" 
                                   placeholder="Enter your full name"
                                   autofocus>
                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

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
                                   placeholder="Enter your email address">
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
                                       autocomplete="new-password"
                                       placeholder="Create a strong password">
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
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    At least 8 characters with letters and numbers
                                </small>
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group-modern">
                            <label for="password-confirm" class="form-label-modern">
                                <i class="fas fa-shield-alt me-2 text-primary"></i>Confirm Password
                            </label>
                            <input id="password-confirm" 
                                   type="password" 
                                   class="form-control form-control-modern" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Confirm your password">
                        </div>

                        <!-- Terms Agreement -->
                        <div class="remember-me mb-3">
                            <input type="checkbox" 
                                   name="terms" 
                                   id="terms" 
                                   required>
                            <label for="terms" class="form-label-modern mb-0">
                                I agree to the <a href="#" class="auth-link">Terms of Service</a> and <a href="#" class="auth-link">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Register Button -->
                        <button type="submit" class="btn btn-auth btn-auth-primary">
                            <i class="fas fa-rocket me-2"></i>Create My Account
                        </button>

                        <!-- Divider -->
                        <div class="auth-divider">
                            <span>Already have an account?</span>
                        </div>

                        <!-- Login Link -->
                        <a href="{{ route('login') }}" class="btn btn-auth btn-auth-outline">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In Instead
                        </a>
                    </form>

                    <!-- Benefits Section -->
                    <div class="mt-4 p-3 rounded-3" style="background-color: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2);">
                        <h6 class="mb-2" style="color: #1f2937; font-weight: 700;">
                            <i class="fas fa-star me-2" style="color: #f093fb;"></i>What you'll get:
                        </h6>
                        <small style="color: #1f2937; font-weight: 500;">
                            ✅ Personal dashboard<br>
                            ✅ Write and publish posts<br>
                            ✅ Join the developer community<br>
                            ✅ Build your developer profile
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

// Password strength indicator
document.addEventListener('DOMContentLoaded', function() {
    const passwordField = document.getElementById('password');
    const confirmField = document.getElementById('password-confirm');
    
    // Password strength validation
    passwordField.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        
        // Visual feedback could be added here
        if (strength >= 3) {
            this.style.borderColor = '#48bb78';
        } else if (strength >= 2) {
            this.style.borderColor = '#ed8936';
        } else {
            this.style.borderColor = '#f56565';
        }
    });
    
    // Password confirmation
    confirmField.addEventListener('input', function() {
        if (this.value === passwordField.value) {
            this.style.borderColor = '#48bb78';
        } else {
            this.style.borderColor = '#f56565';
        }
    });
    
    // Form interactions
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
