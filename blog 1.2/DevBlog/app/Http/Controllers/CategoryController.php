<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

// Sprint 3 - CategoryController for public category browsing
// Handles category listing and category-specific post viewing
class CategoryController extends Controller
{
    // Sprint 3 - Show all categories with post counts
    public function index()
    {
        $categories = Category::active()
            ->withCount(['posts' => function($query) {
                $query->published();
            }])
            ->ordered()
            ->get();

        // Group categories by parent for better organization
        $topLevelCategories = $categories->whereNull('parent_id');
        $childCategories = $categories->whereNotNull('parent_id')->groupBy('parent_id');

        return view('categories.index', compact('categories', 'topLevelCategories', 'childCategories'));
    }

    // Sprint 3 - Show posts in specific category
    public function show($slug, Request $request)
    {
        $category = Category::active()
            ->where('slug', $slug)
            ->firstOrFail();

        // Get posts in this category with related data
        $query = $category->posts()
            ->with(['user', 'categories'])
            ->published();

        // Sprint 3 - Search within category
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Sprint 3 - Sort options
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'popular':
                $query->orderBy('view_count', 'desc');
                break;
            case 'oldest':
                $query->oldest('published_at');
                break;
            case 'latest':
            default:
                $query->latest('published_at');
                break;
        }

        $posts = $query->paginate(12)->withQueryString();

        // Get related categories
        $relatedCategories = Category::active()
            ->where('id', '!=', $category->id)
            ->withCount(['posts' => function($query) {
                $query->published();
            }])
            ->having('posts_count', '>', 0)
            ->limit(6)
            ->get();

        return view('categories.show', compact('category', 'posts', 'relatedCategories', 'sortBy'));
    }
} 