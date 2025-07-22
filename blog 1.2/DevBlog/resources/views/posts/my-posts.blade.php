@extends('layouts.app')

@section('title', 'My Posts')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Sprint 2 - My Posts Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2><i class="fas fa-file-alt me-2"></i>My Posts</h2>
                <p class="text-muted mb-0">Manage your blog posts and track their performance</p>
            </div>
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Create New Post
            </a>
        </div>

        <!-- Sprint 2 - Success Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Sprint 2 - Posts Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-file-alt text-primary mb-2" style="font-size: 2rem;"></i>
                        <h4 class="text-primary">{{ $posts->total() }}</h4>
                        <p class="text-muted mb-0">Total Posts</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-globe text-success mb-2" style="font-size: 2rem;"></i>
                        <h4 class="text-success">{{ $posts->where('status', 'published')->count() }}</h4>
                        <p class="text-muted mb-0">Published</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-edit text-warning mb-2" style="font-size: 2rem;"></i>
                        <h4 class="text-warning">{{ $posts->where('status', 'draft')->count() }}</h4>
                        <p class="text-muted mb-0">Drafts</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-eye text-info mb-2" style="font-size: 2rem;"></i>
                        <h4 class="text-info">{{ $posts->sum('view_count') }}</h4>
                        <p class="text-muted mb-0">Total Views</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sprint 2 - Posts Table -->
        <div class="card">
            <div class="card-body">
                @if($posts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Categories</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <!-- Post Title with Link -->
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($post->featured_image)
                                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                                         alt="Featured" class="rounded me-2" 
                                                         style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-file-alt text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <strong>{{ $post->title }}</strong>
                                                    @if($post->excerpt)
                                                        <br><small class="text-muted">{{ Str::limit($post->excerpt, 80) }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Categories -->
                                        <td>
                                            @if($post->categories->count() > 0)
                                                @foreach($post->categories as $category)
                                                    <span class="badge me-1" style="background-color: {{ $category->color }}">
                                                        @if($category->icon)
                                                            <i class="{{ $category->icon }} me-1"></i>
                                                        @endif
                                                        {{ $category->name }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No categories</span>
                                            @endif
                                        </td>

                                        <!-- Status -->
                                        <td>
                                            @if($post->status === 'published')
                                                <span class="badge bg-success">
                                                    <i class="fas fa-globe me-1"></i>Published
                                                </span>
                                            @elseif($post->status === 'draft')
                                                <span class="badge bg-warning text-dark">
                                                    <i class="fas fa-edit me-1"></i>Draft
                                                </span>
                                            @endif
                                            
                                            @if($post->published_at)
                                                <br><small class="text-muted">{{ $post->published_at->format('M j, Y') }}</small>
                                            @endif
                                        </td>

                                        <!-- Views -->
                                        <td class="text-center">
                                            <span class="badge bg-info">{{ number_format($post->view_count) }}</span>
                                        </td>

                                        <!-- Created Date -->
                                        <td>
                                            <small class="text-muted">
                                                {{ $post->created_at->format('M j, Y') }}
                                                <br>{{ $post->created_at->format('g:i A') }}
                                            </small>
                                        </td>

                                        <!-- Actions -->
                                        <td>
                                            <div class="btn-group" role="group">
                                                <!-- View Post -->
                                                @if($post->isPublished())
                                                    <a href="{{ route('posts.show', $post->slug) }}" 
                                                       class="btn btn-sm btn-outline-primary" title="View Post">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif

                                                <!-- Edit Post -->
                                                <a href="{{ route('posts.edit', $post) }}" 
                                                   class="btn btn-sm btn-outline-secondary" title="Edit Post">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!-- Toggle Status -->
                                                <form action="{{ route('posts.toggle-status', $post) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @if($post->status === 'draft')
                                                        <button type="submit" class="btn btn-sm btn-outline-success" 
                                                                title="Publish Post">
                                                            <i class="fas fa-globe"></i>
                                                        </button>
                                                    @else
                                                        <button type="submit" class="btn btn-sm btn-outline-warning" 
                                                                title="Unpublish Post">
                                                            <i class="fas fa-eye-slash"></i>
                                                        </button>
                                                    @endif
                                                </form>

                                                <!-- Delete Post -->
                                                <form action="{{ route('posts.destroy', $post) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                            title="Delete Post">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Sprint 2 - Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $posts->links() }}
                    </div>
                @else
                    <!-- Sprint 2 - Empty State -->
                    <div class="text-center py-5">
                        <i class="fas fa-file-plus text-muted mb-3" style="font-size: 4rem;"></i>
                        <h4 class="text-muted">No posts yet</h4>
                        <p class="text-muted">You haven't created any posts yet. Start sharing your knowledge with the community!</p>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Create Your First Post
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Sprint 2 - Quick Actions JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Confirm before status changes
    document.querySelectorAll('form[action*="toggle-status"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = form.querySelector('button');
            const isPublishing = button.innerHTML.includes('fa-globe');
            const action = isPublishing ? 'publish' : 'unpublish';
            
            if (!confirm(`Are you sure you want to ${action} this post?`)) {
                e.preventDefault();
            }
        });
    });
});
</script>
@endsection 