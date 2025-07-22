@extends('layouts.app')

@section('title', 'Browse Categories - DevBlog')

@section('content')
<!-- Sprint 3 - Modern Categories Header -->
<section class="py-5 bg-light">
    <div class="container-modern">
        <div class="text-center">
            <h1 class="display-4 mb-3 animate-fade-up">Explore by Topic</h1>
            <p class="lead text-muted animate-fade-up" style="animation-delay: 0.1s;">
                Find content organized by your favorite development topics and technologies
            </p>
        </div>
    </div>
</section>

<!-- Sprint 3 - Categories Grid -->
<section class="py-5">
    <div class="container-modern">
        @if($categories->count() > 0)
            <div class="row g-4">
                @foreach($topLevelCategories as $index => $category)
                    <div class="col-lg-4 col-md-6 animate-fade-up" style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="card-modern h-100">
                            <div class="card-body">
                                <!-- Category Header -->
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3" 
                                         style="width: 60px; height: 60px; background-color: {{ $category->color }}20;">
                                        @if($category->icon)
                                            <i class="{{ $category->icon }} fa-xl" 
                                               style="color: {{ $category->color }};"></i>
                                        @else
                                            <i class="fas fa-tag fa-xl" 
                                               style="color: {{ $category->color }};"></i>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <h4 class="mb-1">
                                            <a href="{{ route('categories.show', $category->slug) }}" 
                                               class="text-decoration-none text-dark">
                                                {{ $category->name }}
                                            </a>
                                        </h4>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="badge badge-modern" 
                                                  style="background-color: {{ $category->color }};">
                                                {{ $category->posts_count }} posts
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Category Description -->
                                @if($category->description)
                                    <p class="text-muted mb-3">{{ $category->description }}</p>
                                @endif
                                
                                <!-- Child Categories -->
                                @if(isset($childCategories[$category->id]))
                                    <div class="mt-3">
                                        <small class="text-muted d-block mb-2">Subtopics:</small>
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($childCategories[$category->id] as $child)
                                                <a href="{{ route('categories.show', $child->slug) }}" 
                                                   class="text-decoration-none">
                                                    <span class="badge bg-light text-dark">
                                                        {{ $child->name }} ({{ $child->posts_count }})
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Recent Posts Preview -->
                                @php
                                    $recentPosts = $category->posts()
                                        ->with('user')
                                        ->published()
                                        ->latest('published_at')
                                        ->limit(3)
                                        ->get();
                                @endphp
                                
                                @if($recentPosts->count() > 0)
                                    <div class="mt-4">
                                        <small class="text-muted d-block mb-2">Recent posts:</small>
                                        @foreach($recentPosts as $post)
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" 
                                                     style="width: 24px; height: 24px; font-size: 0.7rem;">
                                                    {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="{{ route('posts.show', $post->slug) }}" 
                                                       class="text-decoration-none small">
                                                        {{ Str::limit($post->title, 40) }}
                                                    </a>
                                                    <small class="text-muted d-block">{{ $post->published_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Card Footer -->
                            <div class="card-footer bg-transparent border-0">
                                <a href="{{ route('categories.show', $category->slug) }}" 
                                   class="btn btn-outline-primary btn-modern w-100">
                                    <i class="fas fa-arrow-right me-2"></i>Explore {{ $category->name }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- All Categories (Flat List) -->
            @if($categories->where('parent_id', '!=', null)->count() > 0)
                <div class="mt-5">
                    <h3 class="mb-4 text-center animate-fade-up">All Subtopics</h3>
                    <div class="row g-2">
                        @foreach($categories->where('parent_id', '!=', null) as $category)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <a href="{{ route('categories.show', $category->slug) }}" 
                                   class="text-decoration-none">
                                    <div class="card-modern p-3 text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-2">
                                            @if($category->icon)
                                                <i class="{{ $category->icon }} me-2" 
                                                   style="color: {{ $category->color }};"></i>
                                            @endif
                                            <span class="fw-medium">{{ $category->name }}</span>
                                        </div>
                                        <small class="text-muted">{{ $category->posts_count }} posts</small>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <div class="animate-fade-up">
                    <i class="fas fa-tags text-muted mb-4" style="font-size: 5rem;"></i>
                    <h3 class="text-muted mb-3">No categories yet</h3>
                    <p class="text-muted">Categories will appear here once content is organized by topics.</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary-modern btn-modern">
                        <i class="fas fa-newspaper me-2"></i>Browse All Posts
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Sprint 3 - Popular Topics -->
@if($categories->count() > 0)
    <section class="py-5 bg-light">
        <div class="container-modern">
            <h3 class="mb-4 text-center animate-fade-up">Most Popular Topics</h3>
            <div class="row justify-content-center">
                @php
                    $popularCategories = $categories->sortByDesc('posts_count')->take(6);
                @endphp
                
                @foreach($popularCategories as $index => $category)
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 animate-fade-up" 
                         style="animation-delay: {{ $index * 0.05 }}s;">
                        <a href="{{ route('categories.show', $category->slug) }}" 
                           class="text-decoration-none">
                            <div class="text-center p-3">
                                <div class="rounded-circle mx-auto mb-2 d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px; background-color: {{ $category->color }}20;">
                                    @if($category->icon)
                                        <i class="{{ $category->icon }}" 
                                           style="color: {{ $category->color }};"></i>
                                    @else
                                        <i class="fas fa-tag" 
                                           style="color: {{ $category->color }};"></i>
                                    @endif
                                </div>
                                <h6 class="mb-1">{{ $category->name }}</h6>
                                <small class="text-muted">{{ $category->posts_count }}</small>
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
// Sprint 3 - Category interactions
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects to category cards
    document.querySelectorAll('.card-modern').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>
@endpush
@endsection 