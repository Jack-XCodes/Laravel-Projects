<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

// Sprint 2 - PostController for blog post CRUD operations
// Handles post creation, editing, deletion, and management
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    // Sprint 2 - Show all posts (for public view)
    public function index(Request $request)
    {
        $query = Post::with(['user', 'categories'])->published();

        // Sprint 2 - Category filtering
        if ($request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->whereHas('categories', function ($q) use ($category) {
                    $q->where('categories.id', $category->id);
                });
            }
        }

        // Sprint 2 - Search functionality
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->latest('published_at')->paginate(12);

        return view('posts.index', compact('posts'));
    }

    // Sprint 2 - Show user's own posts
    public function myPosts()
    {
        $posts = Post::with(['categories'])
                    ->byUser(Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('posts.my-posts', compact('posts'));
    }

    // Sprint 2 - Show single post
    public function show($slug)
    {
        $post = Post::with(['user', 'categories'])->where('slug', $slug)->firstOrFail();

        // Sprint 2 - Only show published posts to non-owners
        if (!$post->isPublished() && (!Auth::check() || Auth::id() !== $post->user_id)) {
            abort(404);
        }

        // Sprint 2 - Increment view count
        if (Auth::id() !== $post->user_id) {
            $post->incrementViews();
        }

        return view('posts.show', compact('post'));
    }

    // Sprint 2 - Show create post form
    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('posts.create', compact('categories'));
    }

    // Sprint 2 - Store new post
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Sprint 2 - Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('post-images', 'public');
            $validated['featured_image'] = $path;
        }

        // Sprint 2 - Set published_at for published posts
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        $validated['user_id'] = Auth::id();

        $post = Post::create($validated);

        // Sprint 2 - Attach categories
        if (isset($validated['categories'])) {
            $post->categories()->attach($validated['categories']);
        }

        return redirect()->route('posts.my')->with('success', 'Post created successfully!');
    }

    // Sprint 2 - Show edit post form
    public function edit(Post $post)
    {
        // Sprint 2 - Check ownership
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::active()->ordered()->get();
        $selectedCategories = $post->categories->pluck('id')->toArray();

        return view('posts.edit', compact('post', 'categories', 'selectedCategories'));
    }

    // Sprint 2 - Update post
    public function update(Request $request, Post $post)
    {
        // Sprint 2 - Check ownership
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        // Sprint 2 - Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            
            $path = $request->file('featured_image')->store('post-images', 'public');
            $validated['featured_image'] = $path;
        }

        // Sprint 2 - Set published_at for newly published posts
        if ($validated['status'] === 'published' && $post->status !== 'published') {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        // Sprint 2 - Sync categories
        if (isset($validated['categories'])) {
            $post->categories()->sync($validated['categories']);
        } else {
            $post->categories()->detach();
        }

        return redirect()->route('posts.my')->with('success', 'Post updated successfully!');
    }

    // Sprint 2 - Delete post
    public function destroy(Post $post)
    {
        // Sprint 2 - Check ownership
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        // Sprint 2 - Delete featured image
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('posts.my')->with('success', 'Post deleted successfully!');
    }

    // Sprint 2 - Toggle post status (publish/unpublish)
    public function toggleStatus(Post $post)
    {
        // Sprint 2 - Check ownership
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        if ($post->status === 'draft') {
            $post->update([
                'status' => 'published',
                'published_at' => now(),
            ]);
            $message = 'Post published successfully!';
        } else {
            $post->update([
                'status' => 'draft',
                'published_at' => null,
            ]);
            $message = 'Post unpublished successfully!';
        }

        return back()->with('success', $message);
    }
} 