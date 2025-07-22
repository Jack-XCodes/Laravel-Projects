<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

// Sprint 2 - Post Seeder for demo content
// Creates sample posts to demonstrate Sprint 2 functionality
class PostSeeder extends Seeder
{
    public function run()
    {
        // Get users and categories
        $johnDoe = User::where('email', 'john@devblog.com')->first();
        $janeSmith = User::where('email', 'jane@devblog.com')->first();
        $alexDev = User::where('email', 'alex@devblog.com')->first();

        $laravelCategory = Category::where('name', 'Laravel')->first();
        $phpCategory = Category::where('name', 'PHP')->first();
        $tutorialCategory = Category::where('name', 'Tutorial')->first();
        $tipsCategory = Category::where('name', 'Tips & Tricks')->first();

        // Sample posts
        $posts = [
            [
                'title' => 'Getting Started with Laravel 12: A Complete Guide',
                'content' => "<h2>Welcome to Laravel 12</h2>

<p>Laravel 12 introduces exciting new features and improvements that make web development even more enjoyable. In this comprehensive guide, we'll explore the key features and how to get started.</p>

<h3>What's New in Laravel 12</h3>
<ul>
<li><strong>Enhanced Performance:</strong> Faster routing and database queries</li>
<li><strong>New Artisan Commands:</strong> More powerful CLI tools</li>
<li><strong>Improved Security:</strong> Better protection against common vulnerabilities</li>
<li><strong>Modern PHP Support:</strong> Full PHP 8.3+ compatibility</li>
</ul>

<h3>Installation</h3>
<p>Getting started with Laravel 12 is simple:</p>
<pre><code>composer create-project laravel/laravel my-app
cd my-app
php artisan serve</code></pre>

<h3>Key Features to Explore</h3>
<p>Laravel 12 builds upon the solid foundation of previous versions while introducing modern development patterns and tools that make building web applications faster and more secure.</p>

<p>Whether you're a beginner or experienced developer, Laravel 12 provides the tools you need to build robust web applications quickly and efficiently.</p>",
                'excerpt' => 'A comprehensive guide to getting started with Laravel 12, covering new features, installation, and key concepts for modern web development.',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'user_id' => $johnDoe->id,
                'view_count' => 245,
                'categories' => [$laravelCategory->id, $tutorialCategory->id],
            ],
            [
                'title' => 'Modern PHP Best Practices in 2025',
                'content' => "<h2>Writing Clean, Modern PHP Code</h2>

<p>PHP has evolved significantly over the years. In 2025, writing modern PHP code means embracing new features, following best practices, and using the right tools.</p>

<h3>PHP 8.3+ Features You Should Use</h3>
<ul>
<li><strong>Typed Properties:</strong> Ensure data integrity with type declarations</li>
<li><strong>Constructor Property Promotion:</strong> Reduce boilerplate code</li>
<li><strong>Union Types:</strong> More flexible type declarations</li>
<li><strong>Match Expressions:</strong> Cleaner conditional logic</li>
<li><strong>Readonly Properties:</strong> Immutable object properties</li>
</ul>

<h3>Code Example</h3>
<pre><code>readonly class UserProfile
{
    public function __construct(
        public string \$name,
        public string \$email,
        public DateTimeImmutable \$createdAt,
    ) {}
    
    public function getAgeGroup(): string
    {
        return match (true) {
            \$this->createdAt->diff(new DateTime())->y < 1 => 'new',
            \$this->createdAt->diff(new DateTime())->y < 5 => 'regular',
            default => 'veteran'
        };
    }
}</code></pre>

<h3>Development Tools</h3>
<p>Use modern tools to improve your PHP development workflow:</p>
<ul>
<li>PHPStan for static analysis</li>
<li>PHP CS Fixer for code formatting</li>
<li>Composer for dependency management</li>
<li>PHPUnit for testing</li>
</ul>

<p>Following these practices will make your PHP code more maintainable, secure, and performant.</p>",
                'excerpt' => 'Learn modern PHP best practices for 2025, including new language features, development tools, and coding standards.',
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'user_id' => $alexDev->id,
                'view_count' => 189,
                'categories' => [$phpCategory->id, $tipsCategory->id],
            ],
            [
                'title' => 'Building a Multi-User Blog with Laravel Livewire',
                'content' => "<h2>Creating Dynamic Web Applications</h2>

<p>Laravel Livewire allows you to build dynamic, interactive web applications using PHP instead of JavaScript. In this tutorial, we'll build a multi-user blog platform.</p>

<h3>Why Livewire?</h3>
<p>Livewire combines the simplicity of server-side rendering with the interactivity of single-page applications:</p>
<ul>
<li>No complex JavaScript frameworks to learn</li>
<li>Real-time updates without page refreshes</li>
<li>Built-in validation and error handling</li>
<li>Seamless Laravel integration</li>
</ul>

<h3>Project Structure</h3>
<p>Our blog platform will include:</p>
<ul>
<li>User authentication and profiles</li>
<li>Post creation and management</li>
<li>Category organization</li>
<li>Real-time comments (coming in Sprint 4)</li>
<li>Like and bookmark system (coming in Sprint 4)</li>
</ul>

<h3>Getting Started</h3>
<p>First, install Livewire in your Laravel project:</p>
<pre><code>composer require livewire/livewire</code></pre>

<p>Then create your first Livewire component:</p>
<pre><code>php artisan make:livewire PostEditor</code></pre>

<h3>Building the Post Editor</h3>
<p>The PostEditor component will handle post creation and editing with real-time validation and auto-save functionality.</p>

<p>This approach allows us to build rich, interactive features while staying within the Laravel ecosystem we know and love.</p>",
                'excerpt' => 'Learn how to build a dynamic multi-user blog platform using Laravel Livewire for interactive features without complex JavaScript.',
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'user_id' => $janeSmith->id,
                'view_count' => 156,
                'categories' => [$laravelCategory->id, $tutorialCategory->id],
            ],
            [
                'title' => 'Draft: Advanced Database Optimization Techniques',
                'content' => "<h2>Optimizing Database Performance</h2>

<p>This post is still being written. It will cover advanced techniques for optimizing database queries and improving application performance.</p>

<h3>Topics to Cover</h3>
<ul>
<li>Query optimization strategies</li>
<li>Indexing best practices</li>
<li>Caching strategies</li>
<li>Database profiling tools</li>
</ul>

<p>More content coming soon...</p>",
                'excerpt' => 'A work-in-progress guide to advanced database optimization techniques for high-performance web applications.',
                'status' => 'draft',
                'published_at' => null,
                'user_id' => $alexDev->id,
                'view_count' => 0,
                'categories' => [],
            ],
        ];

        foreach ($posts as $postData) {
            $categories = $postData['categories'] ?? [];
            unset($postData['categories']);
            
            $post = Post::create($postData);
            
            if (!empty($categories)) {
                $post->categories()->attach($categories);
            }
        }

        $this->command->info('Sprint 2 - Sample posts created successfully!');
        $this->command->info('Created posts:');
        $this->command->info('- 3 Published posts with various categories');
        $this->command->info('- 1 Draft post for testing');
        $this->command->info('- Posts assigned to different users');
    }
} 