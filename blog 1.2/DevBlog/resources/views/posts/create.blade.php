@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <!-- Sprint 2 - Post Creation Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2><i class="fas fa-plus-circle me-2"></i>Create New Post</h2>
                <p class="text-muted mb-0">Share your thoughts and knowledge with the DevBlog community</p>
            </div>
            <a href="{{ route('posts.my') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to My Posts
            </a>
        </div>

        <!-- Sprint 2 - Post Creation Form -->
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <!-- Sprint 2 - Main Content Column -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <!-- Sprint 2 - Post Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Post Title *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title') }}" 
                                       placeholder="Enter your post title..." required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sprint 2 - Post Content (Rich Text Editor) -->
                            <div class="mb-3">
                                <label for="content" class="form-label">Content *</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="content" name="content" rows="15" required
                                          placeholder="Write your post content here...">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Rich text editor coming in future update. Use Markdown syntax for now.
                                </div>
                            </div>

                            <!-- Sprint 2 - Post Excerpt -->
                            <div class="mb-3">
                                <label for="excerpt" class="form-label">Excerpt (Optional)</label>
                                <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                          id="excerpt" name="excerpt" rows="3" 
                                          placeholder="Brief description of your post (will auto-generate if empty)">{{ old('excerpt') }}</textarea>
                                @error('excerpt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Leave empty to auto-generate from content</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sprint 2 - Sidebar Column -->
                <div class="col-md-4">
                    <!-- Sprint 2 - Post Settings Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-cog me-2"></i>Post Settings
                            </h6>
                        </div>
                        <div class="card-body">
                            <!-- Sprint 2 - Post Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" 
                                        id="status" name="status">
                                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>
                                        <i class="fas fa-edit"></i> Draft
                                    </option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>
                                        <i class="fas fa-globe"></i> Published
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sprint 2 - Categories -->
                            <div class="mb-3">
                                <label class="form-label">Categories</label>
                                @if($categories->count() > 0)
                                    <div class="category-checkboxes" style="max-height: 150px; overflow-y: auto;">
                                        @foreach($categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="categories[]" value="{{ $category->id }}" 
                                                       id="category_{{ $category->id }}"
                                                       {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="category_{{ $category->id }}">
                                                    <span class="badge" style="background-color: {{ $category->color }}">
                                                        @if($category->icon)
                                                            <i class="{{ $category->icon }} me-1"></i>
                                                        @endif
                                                        {{ $category->name }}
                                                    </span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-muted">
                                        <i class="fas fa-info-circle me-2"></i>
                                        No categories available. Contact admin to add categories.
                                    </div>
                                @endif
                                @error('categories')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sprint 2 - Featured Image Upload -->
                            <div class="mb-3">
                                <label for="featured_image" class="form-label">Featured Image</label>
                                <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                       id="featured_image" name="featured_image" accept="image/*">
                                @error('featured_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Max 2MB. Supports: JPG, PNG, GIF</div>
                            </div>
                        </div>
                    </div>

                    <!-- Sprint 2 - SEO Settings Card -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-search me-2"></i>SEO Settings
                            </h6>
                        </div>
                        <div class="card-body">
                            <!-- Meta Title -->
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                       id="meta_title" name="meta_title" value="{{ old('meta_title') }}" 
                                       placeholder="SEO title (leave empty to use post title)">
                                @error('meta_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Meta Description -->
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                          id="meta_description" name="meta_description" rows="3"
                                          placeholder="SEO description (leave empty to auto-generate)">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sprint 2 - Form Actions -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="fas fa-save me-2"></i>Create Post
                                    </button>
                                    <a href="{{ route('posts.my') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                </div>
                                <div class="text-muted">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Your post will be saved with the selected status
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Sprint 2 - JavaScript for enhanced UX -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-resize textarea
    const textarea = document.getElementById('content');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
    });

    // Show status help text
    const statusSelect = document.getElementById('status');
    statusSelect.addEventListener('change', function() {
        const helpText = document.getElementById('status-help');
        if (helpText) helpText.remove();
        
        let text = '';
        if (this.value === 'draft') {
            text = 'Draft posts are only visible to you';
        } else if (this.value === 'published') {
            text = 'Published posts are visible to everyone';
        }
        
        if (text) {
            const help = document.createElement('div');
            help.className = 'form-text';
            help.id = 'status-help';
            help.innerHTML = '<i class="fas fa-info-circle me-1"></i>' + text;
            this.parentNode.appendChild(help);
        }
    });
});
</script>
@endsection 