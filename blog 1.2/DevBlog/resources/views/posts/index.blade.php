@extends('layouts.app')

@section('title', 'All Posts - DevBlog')

@section('content')
<!-- Sprint 3 - Modern Posts Header -->
<section class="py-5 bg-light">
    <div class="container-modern">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 mb-3 animate-fade-left">Discover Amazing Content</h1>
                <p class="lead text-muted animate-fade-left" style="animation-delay: 0.1s;">
                    Explore tutorials, tips, and insights from our developer community
                </p>
            </div>
            <div class="col-lg-4 text-lg-end animate-fade-right" style="animation-delay: 0.2s;">
                <div class="d-flex flex-column flex-lg-row gap-2">
                    <a href="{{ route('search.index') }}" class="btn btn-outline-primary btn-modern">
                        <i class="fas fa-search me-2"></i>Advanced Search
                    </a>
                    @auth
                        <a href="{{ route('posts.create') }}" class="btn btn-primary-modern btn-modern">
                            <i class="fas fa-plus me-2"></i>Write Post
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sprint 3 - Filters and Search -->
<section class="py-4 bg-white shadow-sm">
    <div class="container-modern">
        <form method="GET" action="{{ route('posts.index') }}" class="row g-3 align-items-center">
            <!-- Search Input -->
            <div class="col-lg-4">
                <div class="position-relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           class="form-control form-control-modern ps-5" 
                           placeholder="Search posts...">
                    <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                </div>
            </div>
            
            <!-- Category Filter -->
            <div class="col-lg-3">
                <select name="category" class="form-select form-control-modern">
                    <option value="">All Categories</option>
                    @foreach(\App\Models\Category::active()->ordered()->get() as $category)
                        <option value="{{ $category->slug }}" 
                                {{ request('category') === $category->slug ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- Sort Options -->
            <div class="col-lg-3">
                <select name="sort" class="form-select form-control-modern">
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                </select>
            </div>
            
            <!-- Filter Button -->
            <div class="col-lg-2">
                <button type="submit" class="btn btn-primary-modern btn-modern w-100">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>
            </div>
        </form>
        
        <!-- Active Filters Display -->
        @if(request()->hasAny(['search', 'category', 'sort']))
            <div class="mt-3 d-flex flex-wrap align-items-center gap-2">
                <span class="text-muted small">Active filters:</span>
                
                @if(request('search'))
                    <span class="badge bg-primary badge-modern">
                        Search: "{{ request('search') }}"
                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" 
                           class="text-white ms-1 text-decoration-none">×</a>
                    </span>
                @endif
                
                @if(request('category'))
                    @php
                        $selectedCategory = \App\Models\Category::where('slug', request('category'))->first();
                    @endphp
                    @if($selectedCategory)
                        <span class="badge badge-modern" style="background-color: {{ $selectedCategory->color }}">
                            {{ $selectedCategory->name }}
                            <a href="{{ request()->fullUrlWithQuery(['category' => null]) }}" 
                               class="text-white ms-1 text-decoration-none">×</a>
                        </span>
                    @endif
                @endif
                
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-secondary">
                    Clear All
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Sprint 3 - Posts Grid -->
<section class="py-5">
    <div class="container-modern">
        @if($posts->count() > 0)
            <!-- Results Count -->
            <div class="mb-4">
                <p class="text-muted">
                    <i class="fas fa-newspaper me-2"></i>
                    {{ $posts->total() }} posts found
                    @if(request('search'))
                        for "{{ request('search') }}"
                    @endif
                </p>
            </div>
            
            <!-- Posts Grid -->
            <div class="row g-4">
                @foreach($posts as $index => $post)
                    <div class="col-lg-6 col-xl-4 animate-fade-up" style="animation-delay: {{ ($index % 12) * 0.05 }}s;">
                        <article class="card-modern h-100">
                            <!-- Featured Image -->
                            @if($post->featured_image)
                                <div class="position-relative overflow-hidden" style="height: 220px;">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-100 h-100 object-fit-cover">
                                    
                                    <!-- Reading Time Overlay -->
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-dark bg-opacity-75">
                                            <i class="fas fa-clock me-1"></i>{{ $post->reading_time }} min
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                     style="height: 220px;">
                                    <i class="fas fa-file-alt text-muted" style="font-size: 3rem;"></i>
                                </div>
                            @endif
                            
                            <div class="card-body">
                                <!-- Categories -->
                                @if($post->categories->count() > 0)
                                    <div class="mb-3">
                                        @foreach($post->categories->take(2) as $category)
                                            <a href="{{ route('categories.show', $category->slug) }}" 
                                               class="text-decoration-none">
                                                <span class="badge badge-modern me-1" 
                                                      style="background-color: {{ $category->color }};">
                                                    @if($category->icon)
                                                        <i class="{{ $category->icon }} me-1"></i>
                                                    @endif
                                                    {{ $category->name }}
                                                </span>
                                            </a>
                                        @endforeach
                                        @if($post->categories->count() > 2)
                                            <span class="badge bg-light text-dark">+{{ $post->categories->count() - 2 }}</span>
                                        @endif
                                    </div>
                                @endif
                                
                                <!-- Title -->
                                <h5 class="card-title mb-3">
                                    <a href="{{ route('posts.show', $post->slug) }}" 
                                       class="text-decoration-none text-dark">
                                        {{ $post->title }}
                                    </a>
                                </h5>
                                
                                <!-- Excerpt -->
                                <p class="text-muted mb-3">{{ $post->excerpt }}</p>
                                
                                <!-- Author and Meta -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" 
                                             style="width: 28px; height: 28px; font-size: 0.75rem;">
                                            {{ strtoupper(substr($post->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">{{ $post->user->display_name }}</small>
                                            <small class="text-muted">{{ $post->published_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                    
                                    <div class="text-muted small">
                                        <i class="fas fa-eye me-1"></i>{{ number_format($post->view_count) }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card Footer -->
                            <div class="card-footer bg-transparent border-0 pt-0">
                                <a href="{{ route('posts.show', $post->slug) }}" 
                                   class="btn btn-outline-primary btn-sm w-100">
                                    Read Full Article <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $posts->withQueryString()->links() }}
            </div>
            
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="animate-fade-up">
                    <i class="fas fa-search text-muted mb-4" style="font-size: 5rem;"></i>
                    <h3 class="text-muted mb-3">No posts found</h3>
                    
                    @if(request()->hasAny(['search', 'category']))
                        <p class="text-muted mb-4">
                            Try adjusting your search criteria or browse all posts
                        </p>
                        <a href="{{ route('posts.index') }}" class="btn btn-primary-modern btn-modern me-3">
                            <i class="fas fa-list me-2"></i>View All Posts
                        </a>
                    @else
                        <p class="text-muted mb-4">
                            Be the first to share your knowledge with the community!
                        </p>
                        @auth
                            <a href="{{ route('posts.create') }}" class="btn btn-primary-modern btn-modern">
                                <i class="fas fa-plus me-2"></i>Write First Post
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary-modern btn-modern">
                                <i class="fas fa-user-plus me-2"></i>Join Community
                            </a>
                        @endauth
                    @endif
                    
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-primary btn-modern">
                        <i class="fas fa-tags me-2"></i>Browse Categories
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Sprint 3 - Suggested Categories -->
@if($posts->count() > 0)
    <section class="py-5 bg-light">
        <div class="container-modern">
            <h3 class="mb-4 text-center animate-fade-up">Explore More Topics</h3>
            <div class="row g-3">
                @php
                    $suggestedCategories = collect(); // Initialize empty collection
                    try {
                        $suggestedCategories = \App\Models\Category::active()
                            ->withCount(['posts' => function($query) {
                                $query->published();
                            }])
                            ->get()
                            ->filter(function($category) {
                                return $category->posts_count > 0;
                            })
                            ->shuffle()
                            ->take(8);
                    } catch (\Exception $e) {
                        // Handle gracefully if tables don't exist yet
                    }
                @endphp
                
                @foreach($suggestedCategories as $index => $category)
                    <div class="col-lg-3 col-md-4 col-sm-6 animate-fade-up" 
                         style="animation-delay: {{ $index * 0.05 }}s;">
                        <a href="{{ route('categories.show', $category->slug) }}" 
                           class="text-decoration-none">
                            <div class="card-modern text-center">
                                <div class="card-body py-3">
                                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2" 
                                         style="width: 40px; height: 40px; background-color: {{ $category->color }}20;">
                                        @if($category->icon)
                                            <i class="{{ $category->icon }}" 
                                               style="color: {{ $category->color }};"></i>
                                        @else
                                            <i class="fas fa-tag" 
                                               style="color: {{ $category->color }};"></i>
                                        @endif
                                    </div>
                                    <h6 class="mb-1">{{ $category->name }}</h6>
                                    <small class="text-muted">{{ $category->posts_count }} posts</small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@push('scripts')
<script>
// Sprint 3 - Enhanced interactions
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit search form with debounce
    const searchInput = document.querySelector('input[name="search"]');
    let searchTimeout;
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length >= 3 || this.value.length === 0) {
                    this.form.submit();
                }
            }, 500);
        });
    }
    
    // Smooth scrolling for pagination
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
            setTimeout(() => {
                window.location = this.href;
            }, 300);
        });
    });
});
</script>
@endpush
@endsection 