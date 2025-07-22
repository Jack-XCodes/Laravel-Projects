@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Sprint 2 - Post Content -->
        <article class="card">
            <!-- Featured Image -->
            @if($post->featured_image)
                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                     alt="{{ $post->title }}" 
                     class="card-img-top" 
                     style="height: 300px; object-fit: cover;">
            @endif

            <div class="card-body">
                <!-- Post Header -->
                <header class="mb-4">
                    <!-- Categories -->
                    @if($post->categories->count() > 0)
                        <div class="mb-2">
                            @foreach($post->categories as $category)
                                <span class="badge me-1" style="background-color: {{ $category->color }}">
                                    @if($category->icon)
                                        <i class="{{ $category->icon }} me-1"></i>
                                    @endif
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Title -->
                    <h1 class="card-title mb-3">{{ $post->title }}</h1>

                    <!-- Meta Information -->
                    <div class="d-flex align-items-center text-muted mb-3">
                        <div class="d-flex align-items-center me-4">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2"
                                 style="width: 32px; height: 32px;">
                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <small>
                                    By <a href="{{ route('profile.show', $post->user->username) }}" 
                                          class="text-decoration-none">{{ $post->user->display_name }}</a>
                                </small>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock me-1"></i>
                            <small>{{ $post->published_at->format('M j, Y') }}</small>
                        </div>

                        <div class="d-flex align-items-center ms-4">
                            <i class="fas fa-eye me-1"></i>
                            <small>{{ number_format($post->view_count) }} views</small>
                        </div>

                        <div class="d-flex align-items-center ms-4">
                            <i class="fas fa-book-open me-1"></i>
                            <small>{{ $post->reading_time }} min read</small>
                        </div>
                    </div>

                    <!-- Excerpt -->
                    @if($post->excerpt)
                        <div class="alert alert-light">
                            <strong>Summary:</strong> {{ $post->excerpt }}
                        </div>
                    @endif
                </header>

                <!-- Post Content -->
                <div class="post-content">
                    {!! nl2br(e($post->content)) !!}
                </div>

                <!-- Post Footer -->
                <footer class="mt-5 pt-4 border-top">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Author Info -->
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3"
                                     style="width: 48px; height: 48px; font-size: 1.2rem;">
                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h6 class="mb-1">
                                        <a href="{{ route('profile.show', $post->user->username) }}" 
                                           class="text-decoration-none">{{ $post->user->display_name }}</a>
                                    </h6>
                                    @if($post->user->bio)
                                        <p class="text-muted mb-0">{{ Str::limit($post->user->bio, 100) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <!-- Social Actions (Placeholders for Sprint 4) -->
                            <div class="btn-group" role="group">
                                <button class="btn btn-outline-danger" disabled>
                                    <i class="fas fa-heart me-1"></i>Like
                                    <small class="d-block">Sprint 4</small>
                                </button>
                                <button class="btn btn-outline-primary" disabled>
                                    <i class="fas fa-bookmark me-1"></i>Save
                                    <small class="d-block">Sprint 4</small>
                                </button>
                                <button class="btn btn-outline-info" disabled>
                                    <i class="fas fa-share me-1"></i>Share
                                    <small class="d-block">Sprint 4</small>
                                </button>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </article>

        <!-- Comments Section Placeholder (Sprint 4) -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-comments me-2"></i>Comments
                </h5>
            </div>
            <div class="card-body text-center py-5">
                <i class="fas fa-comments text-muted mb-3" style="font-size: 3rem;"></i>
                <h6 class="text-muted">Comments Coming Soon!</h6>
                <p class="text-muted">
                    The commenting system will be available in Sprint 4.
                    <br>Stay tuned for interactive discussions!
                </p>
            </div>
        </div>
    </div>

    <!-- Sprint 2 - Sidebar -->
    <div class="col-md-4">
        <!-- Author's Other Posts -->
        @if($post->user->posts()->published()->where('id', '!=', $post->id)->exists())
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-user me-2"></i>More from {{ $post->user->display_name }}
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($post->user->posts()->published()->where('id', '!=', $post->id)->latest()->limit(3)->get() as $otherPost)
                        <div class="d-flex align-items-center mb-3">
                            @if($otherPost->featured_image)
                                <img src="{{ asset('storage/' . $otherPost->featured_image) }}" 
                                     alt="Post thumbnail" class="rounded me-2" 
                                     style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px;">
                                    <i class="fas fa-file-alt text-muted"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <h6 class="mb-1">
                                    <a href="{{ route('posts.show', $otherPost->slug) }}" 
                                       class="text-decoration-none">
                                        {{ Str::limit($otherPost->title, 50) }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $otherPost->published_at->format('M j') }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Related Categories -->
        @if($post->categories->count() > 0)
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-tags me-2"></i>Related Categories
                    </h6>
                </div>
                <div class="card-body">
                    @foreach($post->categories as $category)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge" style="background-color: {{ $category->color }}">
                                @if($category->icon)
                                    <i class="{{ $category->icon }} me-1"></i>
                                @endif
                                {{ $category->name }}
                            </span>
                            <small class="text-muted">{{ $category->published_posts_count }} posts</small>
                        </div>
                        @if($category->description)
                            <p class="text-muted small mb-3">{{ $category->description }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Sprint 2 - Back to Posts Navigation -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center">
                <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-2"></i>Back to All Posts
                </a>
                
                @auth
                    @if(auth()->id() === $post->user_id)
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning ms-2">
                            <i class="fas fa-edit me-2"></i>Edit This Post
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- Sprint 2 - Post Content Styling -->
<style>
.post-content {
    font-size: 1.1rem;
    line-height: 1.7;
}

.post-content h2 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #2c3e50;
}

.post-content h3 {
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
    color: #34495e;
}

.post-content p {
    margin-bottom: 1rem;
}

.post-content ul, .post-content ol {
    margin-bottom: 1rem;
    padding-left: 1.5rem;
}

.post-content li {
    margin-bottom: 0.5rem;
}

.post-content pre {
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 0.375rem;
    padding: 1rem;
    overflow-x: auto;
    margin-bottom: 1rem;
}

.post-content code {
    background-color: #f8f9fa;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
}
</style>
@endsection 