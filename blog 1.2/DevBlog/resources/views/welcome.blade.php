@extends('layouts.app')

@section('title', 'Welcome to DevBlog Platform')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto text-center">
        <!-- Sprint 1 - Hero section for new visitors -->
        <div class="card mb-5">
            <div class="card-body py-5">
                <i class="fas fa-blog text-primary mb-3" style="font-size: 64px;"></i>
                <h1 class="display-4 mb-3">Welcome to DevBlog</h1>
                <p class="lead mb-4">
                    A modern blogging platform for developers and writers to share their thoughts, 
                    experiences, and knowledge with the world.
                </p>
                
                @guest
                    <!-- Sprint 1 - Call to action for new users -->
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Get Started
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </a>
                    </div>
                @else
                    <!-- Sprint 1 - Welcome back message for logged-in users -->
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        Welcome back, {{ auth()->user()->name }}! Ready to start writing?
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                    </a>
                @endguest
            </div>
        </div>
        
        <!-- Sprint 1 - Feature preview for upcoming functionality -->
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-pencil-alt text-primary mb-3" style="font-size: 48px;"></i>
                        <h5>Write & Share</h5>
                        <p class="text-muted">Create beautiful posts and share your knowledge with the community.</p>
                        <small class="text-muted">Coming in Sprint 2</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-users text-success mb-3" style="font-size: 48px;"></i>
                        <h5>Connect</h5>
                        <p class="text-muted">Follow other writers and build your network in the community.</p>
                        <small class="text-muted">Coming in Sprint 4</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-search text-warning mb-3" style="font-size: 48px;"></i>
                        <h5>Discover</h5>
                        <p class="text-muted">Find interesting content and explore topics you care about.</p>
                        <small class="text-muted">Coming in Sprint 5</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sprint 1 - Development progress indicator -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-rocket me-2"></i>Development Status
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="text-center">
                            <i class="fas fa-check-circle text-success mb-2" style="font-size: 32px;"></i>
                            <h6>Sprint 1</h6>
                            <p class="text-muted mb-0">Authentication & Profiles</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <i class="fas fa-check-circle text-success mb-2" style="font-size: 32px;"></i>
                            <h6>Sprint 2</h6>
                            <p class="text-muted mb-0">Post Creation & Categories</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <i class="fas fa-spinner fa-spin text-primary mb-2" style="font-size: 32px;"></i>
                            <h6>Sprint 3</h6>
                            <p class="text-muted mb-0">Public Frontend</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center">
                            <i class="fas fa-clock text-muted mb-2" style="font-size: 32px;"></i>
                            <h6>Sprint 4</h6>
                            <p class="text-muted mb-0">Social Features</p>
                        </div>
                    </div>
                </div>
                
                <div class="progress mt-4">
                    <div class="progress-bar bg-success" style="width: 50%"></div>
                    <div class="progress-bar bg-primary" style="width: 10%"></div>
                    <div class="progress-bar bg-light" style="width: 40%"></div>
                </div>
                <div class="text-center mt-2">
                    <small class="text-muted">Sprint 2 Complete: Post Creation & Content Organization | Sprint 3 In Progress: Public Frontend</small>
                </div>
            </div>
        </div>
        
        <!-- Sprint 1 - Current working features -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-check-circle me-2"></i>What's Working Now
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>User Registration & Login</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Username-based Profiles</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Personal Dashboard</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Post Creation & Management</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Categories & Content Organization</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Profile Editing</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Password Management</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            <span>Responsive Design</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
