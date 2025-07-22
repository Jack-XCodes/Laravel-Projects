@extends('layouts.app')

@section('title', 'DevBlog - Modern Developer Platform')

@section('content')
<!-- Sprint 3 - Modern Hero Section -->
<section class="hero-section">
    <div class="container-modern">
        <div class="row align-items-center min-vh-70">
            <div class="col-lg-6">
                <div class="hero-content text-white">
                    <h1 class="display-1-modern animate-fade-left text-white">
                        Share Your
                        <span class="d-block text-white" style="text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                            Developer Journey
                        </span>
                    </h1>
                    <p class="lead-modern animate-fade-left text-white" style="animation-delay: 0.2s; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">
                        Join a community of passionate developers sharing knowledge, tutorials, and insights. 
                        Build your portfolio, grow your network, and inspire others.
                    </p>
                    <div class="mt-4 animate-fade-left" style="animation-delay: 0.4s;">
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-light btn-modern me-3">
                                <i class="fas fa-rocket me-2"></i>Start Writing
                            </a>
                            <a href="{{ route('posts.index') }}" class="btn btn-outline-light btn-modern">
                                <i class="fas fa-compass me-2"></i>Explore Posts
                            </a>
                        @else
                            <a href="{{ route('posts.create') }}" class="btn btn-light btn-modern me-3">
                                <i class="fas fa-plus me-2"></i>Write New Post
                            </a>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-modern">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="animate-fade-right animate-float" style="animation-delay: 0.6s;">
                    <div class="text-center">
                        <div class="position-relative">
                            <div class="bg-white rounded-4 p-4 shadow-lg" style="transform: rotate(-5deg);">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" 
                                         style="width: 40px; height: 40px;">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 text-dark">Alex Developer</h6>
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                </div>
                                <h5 class="text-dark mb-2">Building Modern Web Apps with Laravel</h5>
                                <p class="text-muted small mb-3">Discover the latest techniques for creating responsive, performant applications...</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="badge bg-primary me-1">Laravel</span>
                                        <span class="badge bg-success">Tutorial</span>
                                    </div>
                                    <div class="text-muted small">
                                        <i class="fas fa-heart me-1"></i>24
                                        <i class="fas fa-eye ms-2 me-1"></i>156
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sprint 3 - Features Section -->
<section class="py-5">
    <div class="container-modern">
        <div class="text-center mb-5">
            <h2 class="h1 mb-3 animate-fade-up">Why Choose DevBlog?</h2>
            <p class="lead text-muted animate-fade-up" style="animation-delay: 0.2s;">
                Everything you need to share knowledge and build your developer brand
            </p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 animate-fade-up" style="animation-delay: 0.1s;">
                <div class="card-modern h-100">
                    <div class="card-body text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-rocket text-primary fa-2x"></i>
                        </div>
                        <h4 class="mb-3">Easy Publishing</h4>
                        <p class="text-muted">
                            Rich text editor, image uploads, and SEO optimization built-in. 
                            Focus on writing, we handle the rest.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 animate-fade-up" style="animation-delay: 0.2s;">
                <div class="card-modern h-100">
                    <div class="card-body text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-users text-success fa-2x"></i>
                        </div>
                        <h4 class="mb-3">Community Driven</h4>
                        <p class="text-muted">
                            Connect with developers worldwide. Follow your favorites, 
                            engage with content, and build meaningful relationships.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 animate-fade-up" style="animation-delay: 0.3s;">
                <div class="card-modern h-100">
                    <div class="card-body text-center">
                        <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-4" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-chart-line text-info fa-2x"></i>
                        </div>
                        <h4 class="mb-3">Analytics & Growth</h4>
                        <p class="text-muted">
                            Track your content performance, understand your audience, 
                            and grow your developer influence.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sprint 3 - Recent Posts Section -->
<section class="py-5 bg-light">
    <div class="container-modern">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="h1 mb-2 animate-fade-left">Latest Posts</h2>
                <p class="text-muted animate-fade-left" style="animation-delay: 0.1s;">
                    Fresh content from our community
                </p>
            </div>
            <a href="{{ route('posts.index') }}" class="btn btn-primary-modern btn-modern animate-fade-right">
                <i class="fas fa-arrow-right me-2"></i>View All Posts
            </a>
        </div>
        
        <div class="row g-4">
            @php
                $recentPosts = collect(); // Initialize empty collection for now
                try {
                    $recentPosts = \App\Models\Post::with(['user', 'categories'])
                        ->published()
                        ->latest('published_at')
                        ->limit(3)
                        ->get();
                } catch (\Exception $e) {
                    // Handle gracefully if tables don't exist yet
                }
            @endphp
            
            @forelse($recentPosts as $index => $post)
                <div class="col-lg-4 animate-fade-up" style="animation-delay: {{ $index * 0.1 }}s;">
                    <article class="card-modern h-100">
                        @if($post->featured_image)
                            <div class="position-relative overflow-hidden" style="height: 200px;">
                                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-100 h-100 object-fit-cover">
                                <div class="position-absolute top-0 start-0 p-3">
                                    @foreach($post->categories->take(2) as $category)
                                        <span class="badge badge-modern me-1" 
                                              style="background-color: {{ $category->color }};">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" 
                                     style="width: 32px; height: 32px; font-size: 0.8rem;">
                                    {{ strtoupper(substr($post->user->name, 0, 2)) }}
                                </div>
                                <div>
                                    <small class="text-muted">{{ $post->user->display_name }}</small>
                                    <small class="text-muted d-block">{{ $post->published_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            
                            <h5 class="mb-2">
                                <a href="{{ route('posts.show', $post->slug) }}" 
                                   class="text-decoration-none text-dark">
                                    {{ $post->title }}
                                </a>
                            </h5>
                            
                            <p class="text-muted mb-3">{{ $post->excerpt }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted small">
                                    <i class="fas fa-eye me-1"></i>{{ number_format($post->view_count) }}
                                    <i class="fas fa-clock ms-3 me-1"></i>{{ $post->reading_time }} min
                                </div>
                                <a href="{{ route('posts.show', $post->slug) }}" 
                                   class="btn btn-sm btn-outline-primary">
                                    Read More <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="animate-fade-up">
                        <i class="fas fa-newspaper text-muted mb-3" style="font-size: 4rem;"></i>
                        <h4 class="text-muted mb-3">No posts yet</h4>
                        <p class="text-muted">Be the first to share your knowledge with the community!</p>
                        @auth
                            <a href="{{ route('posts.create') }}" class="btn btn-primary-modern btn-modern">
                                <i class="fas fa-plus me-2"></i>Write First Post
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary-modern btn-modern">
                                <i class="fas fa-user-plus me-2"></i>Join Now
                            </a>
                        @endauth
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Sprint 3 - Categories Section -->
<section class="py-5">
    <div class="container-modern">
        <div class="text-center mb-5">
            <h2 class="h1 mb-3 animate-fade-up">Explore Topics</h2>
            <p class="lead text-muted animate-fade-up" style="animation-delay: 0.1s;">
                Discover content organized by your interests
            </p>
        </div>
        
        <div class="row g-3">
            @php
                $popularCategories = \App\Models\Category::active()
                    ->withCount(['posts' => function($query) {
                        $query->published();
                    }])
                    ->get()
                    ->filter(function($category) {
                        return $category->posts_count > 0;
                    })
                    ->sortByDesc('posts_count')
                    ->take(8);
            @endphp
            
            @forelse($popularCategories as $index => $category)
                <div class="col-lg-3 col-md-4 col-sm-6 animate-fade-up" 
                     style="animation-delay: {{ $index * 0.05 }}s;">
                    <a href="{{ route('categories.show', $category->slug) }}" 
                       class="text-decoration-none">
                        <div class="card-modern text-center h-100">
                            <div class="card-body">
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 60px; height: 60px; background-color: {{ $category->color }}20;">
                                    @if($category->icon)
                                        <i class="{{ $category->icon }} fa-lg" 
                                           style="color: {{ $category->color }};"></i>
                                    @else
                                        <i class="fas fa-tag fa-lg" 
                                           style="color: {{ $category->color }};"></i>
                                    @endif
                                </div>
                                <h6 class="mb-2">{{ $category->name }}</h6>
                                <small class="text-muted">{{ $category->posts_count }} posts</small>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center">
                    <div class="animate-fade-up">
                        <i class="fas fa-tags text-muted mb-3" style="font-size: 3rem;"></i>
                        <h5 class="text-muted">Categories coming soon!</h5>
                        <p class="text-muted">Content will be organized by topics once posts are published.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Sprint 3 - CTA Section -->
<section class="py-5" style="background: var(--primary-gradient);">
    <div class="container-modern">
        <div class="text-center text-white">
            <h2 class="h1 mb-3 animate-fade-up">Ready to Start Writing?</h2>
            <p class="lead mb-4 animate-fade-up" style="animation-delay: 0.1s;">
                Join thousands of developers sharing their knowledge and growing their careers
            </p>
            <div class="animate-fade-up" style="animation-delay: 0.2s;">
                @guest
                    <a href="{{ route('register') }}" class="btn btn-light btn-modern btn-lg me-3">
                        <i class="fas fa-rocket me-2"></i>Get Started Free
                    </a>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-light btn-modern btn-lg">
                        <i class="fas fa-book-open me-2"></i>Read Posts
                    </a>
                @else
                    <a href="{{ route('posts.create') }}" class="btn btn-light btn-modern btn-lg me-3">
                        <i class="fas fa-plus me-2"></i>Write Your First Post
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-modern btn-lg">
                        <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
// Sprint 3 - Add some interactive animations
document.addEventListener('DOMContentLoaded', function() {
    // Animate cards on hover
    document.querySelectorAll('.card-modern').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Add parallax effect to hero section
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('.hero-section');
        if (parallax) {
            const speed = scrolled * 0.5;
            parallax.style.transform = `translateY(${speed}px)`;
        }
    });
});
</script>
@endpush
@endsection
