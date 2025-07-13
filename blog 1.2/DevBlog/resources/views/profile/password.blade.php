@extends('layouts.app')

@section('title', 'Change Password - DevBlog Platform')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-lock me-2"></i>Change Password
                </h4>
                <p class="text-muted mb-0">Update your account password for security</p>
            </div>
            <div class="card-body">
                <!-- Sprint 1 - Password change form with current password verification -->
                <form method="POST" action="{{ route('profile.password.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <!-- Current Password Field -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" 
                               class="form-control @error('current_password') is-invalid @enderror" 
                               id="current_password" 
                               name="current_password" 
                               required 
                               placeholder="Enter your current password">
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            We need your current password to verify your identity
                        </div>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- New Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required 
                               placeholder="Enter your new password">
                        <div class="form-text">
                            <i class="fas fa-shield-alt me-1"></i>
                            Choose a strong password with at least 8 characters
                        </div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Confirm New Password Field -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required 
                               placeholder="Confirm your new password">
                        <div class="form-text">
                            <i class="fas fa-check-circle me-1"></i>
                            Re-enter your new password to confirm
                        </div>
                    </div>
                    
                    <!-- Sprint 1 - Security notice for password changes -->
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Security Notice:</strong> After changing your password, you'll remain logged in on this device, but you'll be logged out of all other devices for security.
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Profile
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Sprint 1 - Password security tips for user guidance -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-lightbulb me-2"></i>Password Security Tips
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                            <div>
                                <h6 class="mb-1">Use a Strong Password</h6>
                                <p class="text-muted mb-0">Mix uppercase, lowercase, numbers, and symbols</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                            <div>
                                <h6 class="mb-1">Make it Unique</h6>
                                <p class="text-muted mb-0">Don't reuse passwords from other accounts</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                            <div>
                                <h6 class="mb-1">Keep it Secret</h6>
                                <p class="text-muted mb-0">Never share your password with anyone</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="fas fa-check-circle text-success me-2 mt-1"></i>
                            <div>
                                <h6 class="mb-1">Change Regularly</h6>
                                <p class="text-muted mb-0">Update your password periodically</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 