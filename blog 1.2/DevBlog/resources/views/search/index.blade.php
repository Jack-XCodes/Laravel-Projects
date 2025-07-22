@extends('layouts.app')

@section('title', 'Search - DevBlog')

@section('content')
<!-- Sprint 3 - Search Header -->
<section class="py-5 bg-light">
    <div class="container-modern">
        <div class="text-center mb-4">
            <h1 class="display-4 mb-3 animate-fade-up">Search & Discover</h1>
            <p class="lead text-muted animate-fade-up" style="animation-delay: 0.1s;">
                Find posts, categories, and authors across the DevBlog community
            </p>
        </div>
        
        <!-- Main Search Form -->
        <div class="row justify-content-center animate-fade-up" style="animation-delay: 0.2s;">
            <div class="col-lg-8">
                <form method="GET" action="{{ route('search.index') }}">
                    <div class="card-modern">
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Search Query -->
                                <div class="col-lg-8">
                                    <div class="position-relative">
                                        <input type="text" 
                                               name="q" 
                                               value="{{ $query }}"
                                               class="form-control form-control-modern ps-5" 
                                               placeholder="Search posts, categories, or authors..."
                                               autocomplete="off">
                                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                    </div>
                                </div>
                                
                                <!-- Search Type -->
                                <div class="col-lg-2">
                                    <select name="type" class="form-select form-control-modern">
                                        <option value="all" {{ $type === 'all' ? 'selected' : '' }}>All</option>
                                        <option value="posts" {{ $type === 'posts' ? 'selected' : '' }}>Posts</option>
                                        <option value="categories" {{ $type === 'categories' ? 'selected' : '' }}>Categories</option>
                                        <option value="users" {{ $type === 'users' ? 'selected' : '' }}>Authors</option>
                                    </select>
                                </div>
                                
                                <!-- Search Button -->
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-primary-modern btn-modern w-100">
                                        <i class="fas fa-search me-2"></i>Search
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Advanced Options -->
                            @if($query)
                                <div class="mt-3">
                                    <div class="row g-2">
                                        <div class="col-auto">
                                            <select name="sort" class="form-select form-select-sm">
                                                <option value="relevance" {{ $sort === 'relevance' ? 'selected' : '' }}>Most Relevant</option>
                                                <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Latest</option>
                                                <option value="popular" {{ $sort === 'popular' ? 'selected' : '' }}>Most Popular</option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                                Update Results
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if($query)
    <!-- Sprint 3 - Search Results -->
    <section class="py-5">
        <div class="container-modern">
            <!-- Results Summary -->
            <div class="mb-4 animate-fade-up">
                <h2 class="h4 mb-2">Search Results for "{{ $query }}"</h2>
                <p class="text-muted">
                    Found {{ $results['posts']->count() + $results['categories']->count() + $results['users']->count() }} results
                    @if($type !== 'all')
                        in {{ ucfirst($type) }}
                    @endif
                </p>
            </div>
            
            @if($type === 'all' || $type === 'posts')
                <!-- Posts Results -->
                @if($results['posts']->count() > 0)
                    <div class="mb-5 animate-fade-up" style="animation-delay: 0.1s;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="h5 mb-0">
                                <i class="fas fa-newspaper me-2 text-primary"></i>
                                Posts ({{ $results['posts']->count() }})
                            </h3>
                            @if($type === 'all' && $results['posts']->count() >= 6)
                                <a href="{{ route('search.index', ['q' => $query, 'type' => 'posts']) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    View All Posts
                                </a>
                            @endif
                        </div>
                        
                        <div class="row g-4">
                            @foreach($results['posts'] as $post)
                                <div class="col-lg-6">
                                    <article class="card-modern">
                                        <div class="row g-0">
                                            @if($post->featured_image)
                                                <div class="col-md-4">
                                                    <div class="h-100 position-relative" style="min-height: 120px;">
                                                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                                             alt="{{ $post->title }}" 
                                                             class="w-100 h-100 object-fit-cover rounded-start">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                            @else
                                                <div class="col-12">
                                            @endif
                                                    <div class="card-body">
                                                        @if($post->categories->count() > 0)
                                                            <div class="mb-2">
                                                                @foreach($post->categories->take(2) as $category)
                                                                    <span class="badge badge-modern me-1" 
                                                                          style="background-color: {{ $category->color }};">
                                                                        {{ $category->name }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                        
                                                        <h6 class="card-title mb-2">
                                                            <a href="{{ route('posts.show', $post->slug) }}" 
                                                               class="text-decoration-none text-dark">
                                                                {{ $post->title }}
                                                            </a>
                                                        </h6>
                                                        
                                                        <p class="text-muted small mb-2">{{ Str::limit($post->excerpt, 100) }}</p>
                                                        
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <small class="text-muted">{{ $post->user->display_name }}</small>
                                                            <div class="text-muted small">
                                                                <i class="fas fa-eye me-1"></i>{{ number_format($post->view_count) }}
                                                                <i class="fas fa-clock ms-2 me-1"></i>{{ $post->reading_time }}m
                                                            </div>
                                                        </div>
                                                    </div>
                                            @if($post->featured_image)
                                                </div>
                                            @endif
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            
            @if($type === 'all' || $type === 'categories')
                <!-- Categories Results -->
                @if($results['categories']->count() > 0)
                    <div class="mb-5 animate-fade-up" style="animation-delay: 0.2s;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="h5 mb-0">
                                <i class="fas fa-tags me-2 text-success"></i>
                                Categories ({{ $results['categories']->count() }})
                            </h3>
                            @if($type === 'all' && $results['categories']->count() >= 6)
                                <a href="{{ route('search.index', ['q' => $query, 'type' => 'categories']) }}" 
                                   class="btn btn-sm btn-outline-success">
                                    View All Categories
                                </a>
                            @endif
                        </div>
                        
                        <div class="row g-3">
                            @foreach($results['categories'] as $category)
                                <div class="col-lg-4 col-md-6">
                                    <a href="{{ route('categories.show', $category->slug) }}" 
                                       class="text-decoration-none">
                                        <div class="card-modern">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                         style="width: 40px; height: 40px; background-color: {{ $category->color }}20;">
                                                        @if($category->icon)
                                                            <i class="{{ $category->icon }}" 
                                                               style="color: {{ $category->color }};"></i>
                                                        @else
                                                            <i class="fas fa-tag" 
                                                               style="color: {{ $category->color }};"></i>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">{{ $category->name }}</h6>
                                                        <small class="text-muted">{{ $category->posts_count }} posts</small>
                                                        @if($category->description)
                                                            <p class="text-muted small mb-0">{{ Str::limit($category->description, 60) }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            
            @if($type === 'all' || $type === 'users')
                <!-- Users Results -->
                @if($results['users']->count() > 0)
                    <div class="mb-5 animate-fade-up" style="animation-delay: 0.3s;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="h5 mb-0">
                                <i class="fas fa-users me-2 text-info"></i>
                                Authors ({{ $results['users']->count() }})
                            </h3>
                            @if($type === 'all' && $results['users']->count() >= 6)
                                <a href="{{ route('search.index', ['q' => $query, 'type' => 'users']) }}" 
                                   class="btn btn-sm btn-outline-info">
                                    View All Authors
                                </a>
                            @endif
                        </div>
                        
                        <div class="row g-3">
                            @foreach($results['users'] as $user)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card-modern">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" 
                                                     style="width: 50px; height: 50px;">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1">
                                                        @if($user->username)
                                                            <a href="{{ route('profile.show', $user->username) }}" 
                                                               class="text-decoration-none text-dark">
                                                                {{ $user->display_name }}
                                                            </a>
                                                        @else
                                                            {{ $user->display_name }}
                                                        @endif
                                                    </h6>
                                                    <small class="text-muted">{{ $user->posts_count }} posts</small>
                                                    @if($user->bio)
                                                        <p class="text-muted small mb-0 mt-1">{{ Str::limit($user->bio, 80) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
            
            <!-- No Results -->
            @if($results['posts']->isEmpty() && $results['categories']->isEmpty() && $results['users']->isEmpty())
                <div class="text-center py-5 animate-fade-up">
                    <i class="fas fa-search text-muted mb-4" style="font-size: 4rem;"></i>
                    <h3 class="text-muted mb-3">No results found</h3>
                    <p class="text-muted mb-4">Try different keywords or browse our suggestions below</p>
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="d-flex flex-wrap gap-2 justify-content-center">
                                @foreach($popularSearches as $suggestion)
                                    <a href="{{ route('search.index', ['q' => $suggestion]) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        {{ $suggestion }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@else
    <!-- Sprint 3 - Search Suggestions -->
    <section class="py-5">
        <div class="container-modern">
            <!-- Popular Searches -->
            <div class="mb-5 animate-fade-up">
                <h3 class="text-center mb-4">Popular Searches</h3>
                <div class="text-center">
                    @foreach($popularSearches as $search)
                        <a href="{{ route('search.index', ['q' => $search]) }}" 
                           class="btn btn-outline-primary btn-modern me-2 mb-2">
                            <i class="fas fa-search me-2"></i>{{ $search }}
                        </a>
                    @endforeach
                </div>
            </div>
            
            <!-- Trending Topics -->
            @if($trendingTopics->count() > 0)
                <div class="animate-fade-up" style="animation-delay: 0.2s;">
                    <h3 class="text-center mb-4">Trending Topics</h3>
                    <div class="row g-3">
                        @foreach($trendingTopics as $topic)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <a href="{{ route('categories.show', $topic->slug) }}" 
                                   class="text-decoration-none">
                                    <div class="card-modern text-center">
                                        <div class="card-body">
                                            <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                                                 style="width: 60px; height: 60px; background-color: {{ $topic->color }}20;">
                                                @if($topic->icon)
                                                    <i class="{{ $topic->icon }} fa-lg" 
                                                       style="color: {{ $topic->color }};"></i>
                                                @else
                                                    <i class="fas fa-tag fa-lg" 
                                                       style="color: {{ $topic->color }};"></i>
                                                @endif
                                            </div>
                                            <h6 class="mb-2">{{ $topic->name }}</h6>
                                            <span class="badge badge-modern" 
                                                  style="background-color: {{ $topic->color }};">
                                                {{ $topic->posts_count }} recent posts
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endif

@push('scripts')
<script>
// Sprint 3 - Search page interactions
document.addEventListener('DOMContentLoaded', function() {
    // Focus search input on page load
    const searchInput = document.querySelector('input[name="q"]');
    if (searchInput && !searchInput.value) {
        searchInput.focus();
    }
    
    // Real-time search suggestions (could be enhanced with AJAX)
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                this.form.submit();
            }
        });
    }
});
</script>
@endpush
@endsection 