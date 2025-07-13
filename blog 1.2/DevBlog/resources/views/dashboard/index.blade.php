@extends('layouts.app')

@section('title', 'Dashboard - DevBlog Platform')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Sprint 1 - Welcome card with user information -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="profile-avatar me-3" style="width: 60px; height: 60px; font-size: 24px;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="mb-1">{{ $welcomeMessage }}</h4>
                        <p class="text-muted mb-0">
                            <i class="fas fa-user me-2"></i>{{ $user->name }} (@{{ $user->username }})
                        </p>
                        <p class="text-muted mb-0">
                            <i class="fas fa-calendar me-2"></i>Member since {{ $joinedDate }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sprint 1 - Activity stats placeholder for future features -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line me-2"></i>Your Activity
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="border-end">
                            <h3 class="text-primary mb-1">{{ $postCount }}</h3>
                            <p class="text-muted mb-0">Posts</p>
                            <small class="text-muted">Sprint 2 feature</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border-end">
                            <h3 class="text-success mb-1">{{ $followerCount }}</h3>
                            <p class="text-muted mb-0">Followers</p>
                            <small class="text-muted">Sprint 4 feature</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-warning mb-1">{{ $likesCount }}</h3>
                        <p class="text-muted mb-0">Likes Received</p>
                        <small class="text-muted">Sprint 4 feature</small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sprint 1 - Recent activity placeholder -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-clock me-2"></i>Recent Activity
                </h5>
            </div>
            <div class="card-body text-center py-5">
                <i class="fas fa-pencil-alt text-muted mb-3" style="font-size: 48px;"></i>
                <h5 class="text-muted">No activity yet</h5>
                <p class="text-muted mb-3">
                    Your recent posts and interactions will appear here once you start writing.
                </p>
                <a href="#" class="btn btn-primary disabled">
                    <i class="fas fa-plus me-2"></i>Create Your First Post
                </a>
                <br><small class="text-muted mt-2">Post creation coming in Sprint 2</small>
            </div>
        </div>
    </div>
    
    <!-- Sprint 1 - Sidebar with quick actions and profile completion -->
    <div class="col-md-4">
        <!-- Quick Actions Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-rocket me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    @if($user->username)
                        <a href="{{ route('profile.show', $user->username) }}" class="btn btn-outline-primary">
                            <i class="fas fa-user me-2"></i>View My Profile
                        </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </a>
                    <a href="{{ route('profile.password') }}" class="btn btn-outline-warning">
                        <i class="fas fa-lock me-2"></i>Change Password
                    </a>
                    <hr>
                    <button class="btn btn-outline-success disabled">
                        <i class="fas fa-plus me-2"></i>Write New Post
                    </button>
                    <small class="text-muted text-center">Coming in Sprint 2</small>
                </div>
            </div>
        </div>
        
        <!-- Sprint 1 - Profile completion tracker -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-tasks me-2"></i>Profile Setup
                </h5>
            </div>
            <div class="card-body">
                <div class="progress mb-3">
                    <div class="progress-bar" style="width: {{ $user->bio ? '100' : '75' }}%"></div>
                </div>
                <div class="checklist">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <span>Account created</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-check-circle text-success me-2"></i>
                        <span>Username set</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        @if($user->bio)
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Bio added</span>
                        @else
                            <i class="fas fa-circle text-muted me-2"></i>
                            <span>Add bio</span>
                        @endif
                    </div>
                </div>
                
                @if(!$user->bio)
                    <div class="mt-3">
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit me-1"></i>Complete Profile
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 