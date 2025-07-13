@extends('layouts.app')

@section('title', $user->name . ' (@' . $user->username . ') - DevBlog Platform')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Sprint 1 - User profile header with basic information -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="profile-avatar me-3" style="width: 80px; height: 80px; font-size: 32px;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h2 class="mb-1">{{ $user->name }}</h2>
                                <p class="text-muted mb-2">@{{ $user->username }}</p>
                            </div>
                            
                            <!-- Sprint 1 - Edit profile button for profile owner -->
                            @if($isOwnProfile)
                                <div>
                                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit me-2"></i>Edit Profile
                                    </a>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Sprint 1 - User bio display -->
                        @if($user->bio)
                            <div class="mt-3">
                                <p class="mb-0">{{ $user->bio }}</p>
                            </div>
                        @else
                            <div class="mt-3">
                                <p class="text-muted mb-0 font-italic">
                                    @if($isOwnProfile)
                                        <i class="fas fa-info-circle me-1"></i>
                                        You haven't added a bio yet. 
                                        <a href="{{ route('profile.edit') }}" class="text-decoration-none">Add one now</a>
                                    @else
                                        This user hasn't added a bio yet.
                                    @endif
                                </p>
                            </div>
                        @endif
                        
                        <!-- Sprint 1 - User stats placeholders -->
                        <div class="mt-3">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="border-end">
                                        <h5 class="mb-1">{{ $postCount }}</h5>
                                        <small class="text-muted">Posts</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border-end">
                                        <h5 class="mb-1">{{ $followerCount }}</h5>
                                        <small class="text-muted">Followers</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="mb-1">{{ $followingCount }}</h5>
                                    <small class="text-muted">Following</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sprint 1 - User posts section placeholder -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-pencil-alt me-2"></i>
                    @if($isOwnProfile)
                        Your Posts
                    @else
                        Posts by {{ $user->name }}
                    @endif
                </h5>
            </div>
            <div class="card-body text-center py-5">
                <i class="fas fa-file-alt text-muted mb-3" style="font-size: 48px;"></i>
                <h5 class="text-muted">No posts yet</h5>
                <p class="text-muted mb-3">
                    @if($isOwnProfile)
                        Your published posts will appear here once you start writing.
                    @else
                        {{ $user->name }} hasn't published any posts yet.
                    @endif
                </p>
                
                @if($isOwnProfile)
                    <a href="#" class="btn btn-primary disabled">
                        <i class="fas fa-plus me-2"></i>Write Your First Post
                    </a>
                    <br><small class="text-muted mt-2">Post creation coming in Sprint 2</small>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Sprint 1 - Profile sidebar with user information -->
    <div class="col-md-4">
        <!-- User Info Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>About
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-calendar text-muted me-2"></i>
                    <span>Joined {{ $joinedDate }}</span>
                </div>
            </div>
        </div>
        
        <!-- Sprint 1 - Follow button placeholder for non-own profiles -->
        @if(!$isOwnProfile)
            <div class="card">
                <div class="card-body text-center">
                    <button class="btn btn-outline-primary disabled w-100">
                        <i class="fas fa-user-plus me-2"></i>Follow
                    </button>
                    <small class="text-muted d-block mt-2">Follow feature coming in Sprint 4</small>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 