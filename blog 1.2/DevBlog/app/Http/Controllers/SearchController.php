<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

// Sprint 3 - SearchController for content discovery
// Handles search functionality across posts, categories, and users
class SearchController extends Controller
{
    // Sprint 3 - Main search functionality
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $type = $request->get('type', 'posts'); // posts, categories, users, all
        $sort = $request->get('sort', 'relevance'); // relevance, latest, popular

        $results = [
            'posts' => collect(),
            'categories' => collect(),
            'users' => collect(),
        ];

        if ($query) {
            // Sprint 3 - Search posts
            if ($type === 'posts' || $type === 'all') {
                $postQuery = Post::with(['user', 'categories'])
                    ->published()
                    ->where(function($q) use ($query) {
                        $q->where('title', 'like', '%' . $query . '%')
                          ->orWhere('content', 'like', '%' . $query . '%')
                          ->orWhere('excerpt', 'like', '%' . $query . '%');
                    });

                // Sort posts
                switch ($sort) {
                    case 'latest':
                        $postQuery->latest('published_at');
                        break;
                    case 'popular':
                        $postQuery->orderBy('view_count', 'desc');
                        break;
                    case 'relevance':
                    default:
                        // Simple relevance: title matches first, then content
                        $postQuery->orderByRaw("
                            CASE 
                                WHEN title LIKE ? THEN 1
                                WHEN excerpt LIKE ? THEN 2
                                WHEN content LIKE ? THEN 3
                                ELSE 4
                            END, published_at DESC
                        ", ['%' . $query . '%', '%' . $query . '%', '%' . $query . '%']);
                        break;
                }

                $results['posts'] = $postQuery->limit($type === 'all' ? 6 : 20)->get();
            }

            // Sprint 3 - Search categories
            if ($type === 'categories' || $type === 'all') {
                $results['categories'] = Category::active()
                    ->withCount(['posts' => function($q) {
                        $q->published();
                    }])
                    ->where(function($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%')
                          ->orWhere('description', 'like', '%' . $query . '%');
                    })
                    ->having('posts_count', '>', 0)
                    ->orderBy('posts_count', 'desc')
                    ->limit($type === 'all' ? 6 : 20)
                    ->get();
            }

            // Sprint 3 - Search users (authors)
            if ($type === 'users' || $type === 'all') {
                $results['users'] = User::whereHas('posts', function($q) {
                        $q->published();
                    })
                    ->withCount(['posts' => function($q) {
                        $q->published();
                    }])
                    ->where(function($q) use ($query) {
                        $q->where('name', 'like', '%' . $query . '%')
                          ->orWhere('username', 'like', '%' . $query . '%')
                          ->orWhere('bio', 'like', '%' . $query . '%');
                    })
                    ->orderBy('posts_count', 'desc')
                    ->limit($type === 'all' ? 6 : 20)
                    ->get();
            }
        }

        // Sprint 3 - Popular searches and suggestions
        $popularSearches = $this->getPopularSearches();
        $trendingTopics = $this->getTrendingTopics();

        return view('search.index', compact(
            'query', 
            'type', 
            'sort', 
            'results', 
            'popularSearches', 
            'trendingTopics'
        ));
    }

    // Sprint 3 - Get popular search suggestions
    private function getPopularSearches()
    {
        // This would typically be stored in database or cache
        // For now, return some common programming topics
        return [
            'Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React', 
            'Database', 'API', 'Tutorial', 'Tips', 'Best Practices'
        ];
    }

    // Sprint 3 - Get trending topics based on recent activity
    private function getTrendingTopics()
    {
        return Category::active()
            ->withCount(['posts' => function($query) {
                $query->published()
                      ->where('published_at', '>=', now()->subWeeks(2));
            }])
            ->having('posts_count', '>', 0)
            ->orderBy('posts_count', 'desc')
            ->limit(8)
            ->get();
    }
} 