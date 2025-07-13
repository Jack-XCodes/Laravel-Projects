@extends('layouts.app')

@section('title', 'Edit Profile - DevBlog Platform')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Edit Your Profile
                </h4>
                <p class="text-muted mb-0">Update your profile information and preferences</p>
            </div>
            <div class="card-body">
                <!-- Sprint 1 - Profile edit form with username and bio -->
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    
                    <!-- Profile Preview -->
                    <div class="text-center mb-4">
                        <div class="profile-avatar mx-auto mb-3" style="width: 80px; height: 80px; font-size: 32px;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <p class="text-muted mb-0">Profile Photo</p>
                        <small class="text-muted">Photo upload coming in future sprint</small>
                    </div>
                    
                    <!-- Full Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user->name) }}" 
                               required 
                               placeholder="Enter your full name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Sprint 1 - Username field for profile URLs -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" 
                               class="form-control @error('username') is-invalid @enderror" 
                               id="username" 
                               name="username" 
                               value="{{ old('username', $user->username) }}" 
                               required 
                               placeholder="Choose a unique username">
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            This will be used in your profile URL: /users/{{ old('username', $user->username) }}
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
                               value="{{ old('email', $user->email) }}" 
                               required 
                               placeholder="Enter your email address">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Sprint 1 - Bio field for user description -->
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" 
                                  id="bio" 
                                  name="bio" 
                                  rows="4" 
                                  maxlength="500" 
                                  placeholder="Tell us about yourself...">{{ old('bio', $user->bio) }}</textarea>
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Share a bit about yourself with other users. Maximum 500 characters.
                        </div>
                        @error('bio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between">
                        @if($user->username)
                            <a href="{{ route('profile.show', $user->username) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                        @endif
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Sprint 1 - Additional account settings -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-cog me-2"></i>Account Settings
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-lock text-muted me-3"></i>
                            <div>
                                <h6 class="mb-1">Password</h6>
                                <p class="text-muted mb-0">Change your password</p>
                            </div>
                            <div class="ms-auto">
                                <a href="{{ route('profile.password') }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit me-1"></i>Change
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-envelope text-muted me-3"></i>
                            <div>
                                <h6 class="mb-1">Email Notifications</h6>
                                <p class="text-muted mb-0">Manage your email preferences</p>
                            </div>
                            <div class="ms-auto">
                                <button class="btn btn-sm btn-outline-secondary disabled">
                                    <i class="fas fa-cog me-1"></i>Soon
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
